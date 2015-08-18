<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Question Controller for handle AJAX requests
 *
 */

class Controller_Question extends Controller_BaseAdmin {

	protected $modelName = "Question";
	
	/**
	 * Get questions for test by level
	 */
	public function action_getQuestionsByLevelRand()
	{
		// get parameters from GET request		
		$test_id = $this->request->param("id");
		$level = $this->request->param("id1");
		$number = $this->request->param("id2");
		
		$result = array();
		$DBResult = null;
		
		$DBResult = Model::factory($this->modelName)->getQuestionsByLevelRand($test_id, $level, $number);
		$fieldNames = Model::factory($this->modelName)->getFieldNames();
		foreach ($DBResult as $data)
		{
			$item = array();
			foreach ($fieldNames as $fieldName) {
				$item[$fieldName] = $data->$fieldName;
			}
			array_push($result, $item);
		}
		if (sizeof($result) < 1)
		{
			$result[] = array('record_id', 'null');
		}
		$r = json_encode($result);
		$this->response->body($r);
	}
	
	/**
	 * Get questions number by test
	 */
	public function action_countRecordsByTest()
	{
		$test_id = $this->request->param("id");
		$numberOfRecords = Model::factory($this->modelName)->countQuestionsByTest($test_id);
		$result = array();
		$result["numberOfRecords"] = $numberOfRecords;
		$r = json_encode($result);
		$this->response->body($r);
	}
	
	public function action_getRecordsRangeByTest()
	{
		$test_id = $this->request->param("id");
		$limit = $this->request->param("id1");
		$offset = $this->request->param("id2");
		$result = array();
	
		// check input parameters
		if ((!is_numeric($test_id)) || (!is_numeric($limit)) || (!is_numeric($offset)))
		{
			$result["response"] = "error";
		}
		else
		{
			$model = Model::factory($this->modelName)->getQuestionsRangeByTest($test_id, $limit, $offset);
			$fieldNames = Model::factory($this->modelName)->getFieldNames();
			foreach ($model as $data)
			{
				$item = array();
				foreach ($fieldNames as $fieldName) {
					$item[$fieldName] = $data->$fieldName;
				}
				array_push($result, $item);
			}
			if (sizeof($result) < 1)
			{
				$result[] = array('record_id', 'null');
			}
		}
		$r = json_encode($result);
		$this->response->body($r);
	}

}