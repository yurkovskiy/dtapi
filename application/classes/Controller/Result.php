<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Result Controller for handle AJAX requests
 *
 */

class Controller_Result extends Controller_BaseAjax {

	protected $modelName = "Result";
	
	// security check -> only admins can see result reports and do some actions
	public function before()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to work with this Entity directly");
		}
		parent::before();
	}
	
	public function action_insertData()
	{
		throw new HTTP_Exception_404("It is prohibited to use this call directly");
	}
	
	public function action_update()
	{
		// nothing to do :-)
		throw new HTTP_Exception_404("Not found for this entity");
	}
	
	public function action_getRecordsByStudent()
	{
		return $this->getEntityRecordsBy("getResultByStudent");
	}
	
	public function action_getRecordsByTestGroupDate()
	{
		$test_id = intval($this->request->param("id"));
		$group_id = intval($this->request->param("id1"));
		$tdate = $this->request->param("id2");
		
		$DBResult = Model::factory($this->modelName)->getResultsByTestAndGroup($test_id, $group_id, $tdate);
		$fieldNames = Model::factory($this->modelName)->getFieldNames();
		$this->buildJSONResponse($DBResult, $fieldNames);
	}
	
	/**
	 * @name getResultTestIdsByGroup
	 * @param int $group_id
	 * 
	 * Returns all test_id(s) which were passed by students of some group ($group_id)
	 */
	public function action_getResultTestIdsByGroup()
	{
		$group_id = intval($this->request->param("id"));
		$DBResult = Model::factory($this->modelName)->getResultTestIdsByGroup($group_id);
		$this->buildJSONResponse($DBResult, array("test_id"));
	}

}
