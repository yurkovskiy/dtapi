<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Base Proxy Controller for handle AJAX requests
 *
 */

abstract class Controller_Base extends Controller {
	
	private $VERSION = "2.2";
	
	// ROLES Constants
	protected $ADMIN_ROLE = "admin";
	protected $STUDENT_ROLE = "student";
	protected $LOGGED_ROLE = "login";
	
	
	/**
	 * @var mixed $DBResult - database object
	 * @var array $fieldNames - array with names of table fields
	 *
	 * Helper method for avoid a lot of duplication
	 */
	protected function buildJSONResponse($DBResult, $fieldNames)
	{
		$result = array();
	
		foreach ($DBResult as $data)
		{
			$item = array();
			foreach ($fieldNames as $fieldName) {
				$item[$fieldName] = html_entity_decode($data->{$fieldName}, ENT_QUOTES);
			}
			array_push($result, $item);
		}
		if (count($result) < 1)
		{
			$result["response"] = "no records";
		}
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
	}

	/**
	 *
	 * @see Kohana_Controller::before()
	 * Auth control added
	 * Only logged users can work with entities
	 */
	public function before()
	{
		try {
			if (!Auth::instance()->logged_in($this->LOGGED_ROLE))
			{
				throw new HTTP_Exception_403("Only logged users can work with entities");
			}
			else
			{
				parent::before();
			}
		} catch (Session_Exception $e) {
			throw new HTTP_Exception_400($e->getMessage());			
		}
	}
	
	/**
	 * @name action_index
	 * @return JSON - with CORE info about system
	 *
	 * This method for default action when the User define only Entity name in URL
	 *
	 */
	public function action_index()
	{
		$result = array("name" => "d-tester API", "version" => $this->VERSION,
				"author" => "Yuriy V. Bezgachnyuk aka Yurkovskiy",
				"startdate" => "20 Aug. 2015",
				"servertime" => date("d/m/Y")." ".date("H:i:s"),
				"hint" => "Please define an action in URL address");
	
		$this->response->body(json_encode($result));
	}

}
