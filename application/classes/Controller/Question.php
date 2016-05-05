<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Question Controller for handle AJAX requests
 *
 */

class Controller_Question extends Controller_BaseAdmin {

	protected $modelName = "Question";
	
	/**
	 * Should be mocked, because a lot of records in DB present
	 * Please use getRecordsRange only
	 * @see Controller_BaseAjax::action_getRecords()
	 */
	public function action_getRecords()
	{
		$record_id = $this->request->param("id");
		if (isset($record_id))
		{
			parent::action_getRecords();
		}
		else 
		{
			throw new HTTP_Exception_400("This method allowed for gathering one record only");
		}
	}
	
	/**
	 * Get questions for test by level
	 * @deprecated will be changed to use getQuestionIdsByLevelRand due to a lot of data	 * 
	 */
	public function action_getQuestionsByLevelRand()
	{
		// get parameters from GET request		
		$test_id = $this->request->param("id");
		$level = $this->request->param("id1");
		$number = $this->request->param("id2");
		
		$result = array();
		$DBResult = null;
		
		// check input parameters
		if ((!is_numeric($test_id)) || (!is_numeric($level)) || (!is_numeric($number)))
		{
			throw new HTTP_Exception_400("Wrong request: fail due to input parameters");
		}
		else 
		{
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
				$result["response"] = "No records";
			}
			$this->response->body(json_encode($result));
		}
	}
	
	/**
	 * Get questions for test by level
	 * @since 2.1
	 */
	public function action_getQuestionIdsByLevelRand()
	{
		// get parameters from GET request
		$test_id = $this->request->param("id");
		$level = $this->request->param("id1");
		$number = $this->request->param("id2");
	
		$result = array();
		$DBResult = null;
	
		// check input parameters
		if ((!is_numeric($test_id)) || (!is_numeric($level)) || (!is_numeric($number)))
		{
			throw new HTTP_Exception_400("Wrong request: fail due to input parameters");
		}
		else
		{
			$DBResult = Model::factory($this->modelName)->getQuestionIdsByLevelRand($test_id, $level, $number);
			$fieldName = Model::factory($this->modelName)->getFieldNames()[0];
			foreach ($DBResult as $data)
			{
				$item = array();
				$item[$fieldName] = $data->$fieldName;
				array_push($result, $item);
			}
			if (sizeof($result) < 1)
			{
				$result["response"] = "No records";
			}
			$this->response->body(json_encode($result));
		}
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
		$this->response->body(json_encode($result));
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
			throw new HTTP_Exception_400("Wrong request: fail due to input parameters");
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
				$result["response"] = "No records";
			}
			$this->response->body(json_encode($result));
		}
	}
} // end of Controller_Question
