<?php defined ( 'SYSPATH' ) or die ( 'No direct script access.' );

/**
 * Admin User Controller for handle AJAX requests
 */
class Controller_AdminUser extends Controller {
	
	private $RAW_DATA_SOURCE = "php://input";
	
	protected $ADMIN_ROLE = "admin";
	
	public function before()
	{
		if (! Auth::instance ()->logged_in ( $this->ADMIN_ROLE ))
		{
			throw new HTTP_Exception_403 ( "You don't have permissions to work with this Entity" );
		}
		else 
		{
			parent::before();
		}
	}
	
	public function action_insertData() 
	{
		// Read POST data in JSON format
		$params = json_decode ( file_get_contents ( $this->RAW_DATA_SOURCE ) );
			
		// Convert Object into Array
		$paramsArr = get_object_vars ( $params );
			
		// Register user
		$model = ORM::factory ( "User" );
		try {
			$model->values ( $paramsArr );
			$model->save ();
			$this->response->body(json_encode(array("id" => $model->id, "response" => "ok")));
		} catch (ORM_Validation_Exception $e) {
			$this->response->body(json_encode(array("response" => $e->getMessage())));
			return;
		}
					
		// Add roles for new user
		$model->add ( 'roles', ORM::factory ( 'role' )->where ( 'name', '=', 'login' )->find () );
		$model->add ( 'roles', ORM::factory ( 'role' )->where ( 'name', '=', 'admin' )->find () );
		
	}
	
	public function action_update()
	{
		$record_id = $this->request->param("id");
				
		// get info from client
		$params = json_decode(file_get_contents($this->RAW_DATA_SOURCE));
		$paramsArr = get_object_vars($params);
			
		try {
			// get record for update
			$model = ORM::factory("User", $record_id);
			$model->values($paramsArr);
			$model->save();
			$this->response->body(json_encode(array("response" => "ok")));
		} catch (ORM_Validation_Exception $e) {
			$this->response->body(json_encode(array("response" => $e->getMessage())));
		}

	}
	
	public function action_del()
	{
		// get record_id from URL
		$record_id = $this->request->param("id");
		
		// get current logged user id
		$user_id = Auth::instance()->get_user()->id;
		
		// check record_id and user id
		if ($record_id == $user_id)
		{
			$this->response->body(json_encode(array("response" => "Error: Cannot erase infomration about oneself")));
			return; 
		}
		
		try {
			$model = ORM::factory("User", $record_id);
			$model->delete();
			$this->response->body(json_encode(array("response" => "ok")));
		} catch (Kohana_Exception $e) {
			$this->response->body(json_encode(array("response" => $e->getMessage())));
		}
	}
	
	public function action_getRecords()
	{
		$result = array();
		$model = null;
		$record_id = $this->request->param("id");
		if (isset($record_id))
		{
			$model = ORM::factory("User", $record_id)->as_array();
		}
		else
		{
			$model = ORM::factory("User")
				->join("roles_users")
				->on("user_id", "=", "user.id")
				->where("role_id", "=", "2")
				->find_all();
		}
		
		$fieldNames = ORM::factory("User")->list_columns();
		
		if (isset($record_id))
		{
			if (!is_null($model["id"])) 
			{
				array_push($result, $model);
			}
			
		}
		else 
		{
			foreach ($model as $user)
			{
				$item = array();
				foreach ($fieldNames as $fieldName) 
				{
					$item[$fieldName["column_name"]] = $user->$fieldName["column_name"];
				}
				array_push($result, $item);
			}
		}
		
		if (sizeof($result) < 1)
		{
			$result["response"] = "No records";
		}
		$this->response->body(json_encode($result));
	}
}
