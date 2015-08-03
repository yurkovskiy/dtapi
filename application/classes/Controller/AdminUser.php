<?php defined ( 'SYSPATH' ) or die ( 'No direct script access.' );

/**
 * Admin User Controller for handle AJAX requests
 */
class Controller_AdminUser extends Controller {
	
	private $RAW_DATA_SOURCE = "php://input";
	
	protected $ADMIN_ROLE = "admin";
	
	public function action_insertData() 
	{
		if (! Auth::instance ()->logged_in ( $this->ADMIN_ROLE )) 
		{
			throw new HTTP_Exception_403 ( "You don't have permissions to insert records" );
		} 
		else 
		{
			
			$result = array ();
			// Read POST data in JSON format
			$params = json_decode ( file_get_contents ( $this->RAW_DATA_SOURCE ) );
			
			// Convert Object into Array
			$paramsArr = get_object_vars ( $params );

			// Register user
			$model = ORM::factory ( "User" );
			$model->values ( $paramsArr );
			$model->save ();
			
			// Add roles for new user
			$model->add ( 'roles', ORM::factory ( 'role' )->where ( 'name', '=', 'login' )->find () );
			$model->add ( 'roles', ORM::factory ( 'role' )->where ( 'name', '=', 'admin' )->find () );
		}
	}
}