<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Question Controller for handle AJAX requests
 *
 */

class Controller_Question extends Controller_BaseAdmin {

	// Strong security check for Student
	public function before()
	{
		if (Auth::instance()->logged_in($this->STUDENT_ROLE))
		{
			if (is_null(Session::instance()->get("startTime")))
			{
				throw new HTTP_Exception_403("You cannot call this method without making an quiz");
			}
		}
		parent::before();
	}
	
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
			if (count($result) < $number)
			{
				throw new HTTP_Exception_404("Not enough number of questions for quiz");
			}
			$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
		}
	}
	
	/**
	 * Get questions number by test
	 */
	public function action_countRecordsByTest()
	{
		$test_id = $this->request->param("id");
		$numberOfRecords = Model::factory($this->modelName)->countQuestionsByTest($test_id);
		$this->response->body(json_encode(array("numberOfRecords" => $numberOfRecords), JSON_UNESCAPED_UNICODE));
	}
	
	public function action_getRecordsRangeByTest()
	{
		$test_id = $this->request->param("id");
		$limit = $this->request->param("id1");
		$offset = $this->request->param("id2");
		$without_images = $this->request->param("id3");
		
		$without_images = (is_null($without_images)) ? false : true;
		
		$fieldNames = null;
		
		$result = array();
	
		// check input parameters
		if ((!is_numeric($test_id)) || (!is_numeric($limit)) || (!is_numeric($offset)))
		{
			throw new HTTP_Exception_400("Wrong request: fail due to input parameters");
		}
		else
		{
			$DBResult = Model::factory($this->modelName)->getQuestionsRangeByTest($test_id, $limit, $offset, $without_images);
			$fieldNames = ($without_images) ? Model::factory($this->modelName)->getFieldNames_() : Model::factory($this->modelName)->getFieldNames();
			
			$this->buildJSONResponse($DBResult, $fieldNames);
		}
	}
	
} // end of Controller_Question
