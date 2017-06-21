<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Result Controller for handle AJAX requests
 *
 */

class Controller_Result extends Controller_BaseAjax {

	protected $modelName = "Result";
	
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
	
	public function action_countTestPassesByStudent()
	{
		$student_id = $this->request->param("id");
		$test_id = $this->request->param("id1");
		$result = array();
		if (!is_numeric($student_id) || !is_numeric($test_id))
		{
			throw new HTTP_Exception_400("Wrong request");
		}
		else
		{
			$numberOfRecords = Model::factory($this->modelName)->countTestPassesByStudent($student_id, $test_id);
			$result["numberOfRecords"] = $numberOfRecords;
		}
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
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
		$fieldNames = array("test_id");
		$this->buildJSONResponse($DBResult, $fieldNames);
	}

}
