<?php defined('SYSPATH') or die('No direct script access.');

/**
 * BaseAjax Controller for handle AJAX requests [contain core methods]
 *
 */

abstract class Controller_BaseAjax extends Controller_Base {
	
	// Model for Controller that will be given in child classes 
	protected $modelName = "";
					
	/**
	 * Helper method for refactoring
	 * @name getEntityRecordsBy
	 * @param String $modelMethod
	 */
	protected function getEntityRecordsBy($modelMethod)
	{
		$record_id = $this->request->param("id");
		$result = array();
		
		// little reflection :-)
		$DBResult = Model::factory($this->modelName)->{$modelMethod}($record_id);
		
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
		$this->response->body(json_encode($result));
	}
	
	/**
	 * @name action_getRecords
	 * @author Yuriy Bezgachnyuk
	 * @access public
	 * @method GET
	 * 
	 * Get record(s) from database
	 *  
	 */
	public function action_getRecords() 
	{

		$record_id = $this->request->param("id");			
		$result = array();
		$DBResult = null;
		if ((!isset($record_id)) || (!is_numeric($record_id)) || ($record_id <= 0)) 
		{
			$DBResult = Model::factory($this->modelName)->getRecords();
		}
		else 
		{
			$DBResult = Model::factory($this->modelName)->getRecord($record_id);
		}
		
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
		$this->response->body(json_encode($result));
	
	}
	
	/**
	 * @name getRecordsRange - method which return range of records (for pagination)
	 * @access public
	 * @method GET
	 * @author Yuriy Bezgachnyuk
	 * 
	 */
	public function action_getRecordsRange()
	{
		$limit = $this->request->param("id");
		$offset = $this->request->param("id1");
		$result = array();
		
		// check input parameters
		if ((!is_numeric($limit)) || (!is_numeric($offset)) || ($limit < 0) || ($offset < 0))
		{
			$result["response"] = "Error: wrong request";
		}
		else 
		{
			$model = Model::factory($this->modelName)->getRecordsRange($limit, $offset);
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
		$this->response->body(json_encode($result));
	}
	
	/**
	 * Return number of Records in table (for pagination)
	 * @return JSON object 
	 */
	public function action_countRecords()
	{
		$numberOfRecords = Model::factory($this->modelName)->countRecords();
		$result["numberOfRecords"] = $numberOfRecords;
		$this->response->body(json_encode($result));
	}
	
	// new INSERT
	/**
	 * @name action_insertData
	 * @author Yuriy Bezgachnyuk
	 * @access public
	 * @method POST
	 *
	 * Read and store data of some Entity into the database
	 * Input data must be in JSON format
	 *
	 */
	public function action_insertData()
	{
		$result = array();
		$model = null;
		
		// Read POST data in JSON format
		$params = @json_decode(file_get_contents($this->RAW_DATA_SOURCE));
		
		// check if input data is given
		if (is_null($params))
		{
			$model = "Error: No input data";
		}
		else 
		{
			// Convert Object into Array
			$paramsArr = get_object_vars($params);
			$values = $paramsArr;
			$model = Model::factory($this->modelName)->registerRecord($values);
		}
			
		if (!is_string($model) && is_int($model))
		{
			// Creating response in JSON format
			$result["id"] = $model;
			$result["response"] = "ok";
		}
		else
		{
			if (is_string($model))
			{
				$result["response"] = $model;
			}
			else
			{
				$result["response"] = "error";
			}
				
		}
		$this->response->body(json_encode($result));
	}
	
	// new UPDATE
	/**
	 * @name action_update
	 * @author Yuriy Bezgachnyuk
	 * @access public
	 * @method POST
	 *
	 * Update information of some Entity in database
	 * Using unique record_id for this action
	 *
	 */
	public function action_update()
	{
		// get Record_id from URL
		$record_id = $this->request->param("id");
		$result = array();
		$model = null;
		
		// check URL parameters
		if ((!isset($record_id)) || (!is_numeric($record_id)) || ($record_id <= 0))
		{
			$result["response"] = "Error: Wrong request";
		}
		else 
		{
			// Get data from JSON
			$params = @json_decode(file_get_contents($this->RAW_DATA_SOURCE));
					
			// check if input data is given
			if (is_null($params))
			{
				$model = "No input data";
			}
			
			else 
			{
				$values = get_object_vars($params);
				array_unshift($values, $record_id); // Add record_id value for Primary Key
				$model = Model::factory($this->modelName)->updateRecord($values);
			}
			
			if (!is_string($model) && $model)
			{
				// Creating response in JSON format
				$result["response"] = "ok";
			}
			else
			{
				if (is_string($model))
				{
					$result["response"] = $model;
				}
				else
				{
					$result["response"] = "error";
				}
			}
		}
		$this->response->body(json_encode($result));
	}
	
	/**
	 * @name action_del
	 * @author Yuriy Bezgachnyuk
	 * @access public
	 * @method GET
	 * 
	 * Delete information about Entity from database
	 * Using unique record_id for this action 
	 * 
	 */
	public function action_del()
	{
		$record_id = $this->request->param("id");
		$results = array();
		
		// check URL parameters
		if ((!isset($record_id)) || (!is_numeric($record_id)) || ($record_id <= 0))
		{
			$results["response"] = "Error: Wrong request";
		}
		else 
		{
			$model = Model::factory($this->modelName)->eraseRecord($record_id);
			if (!is_string($model) && $model)
			{
				// Creating response in JSON format
				$result["response"] = "ok";
			}
			else
			{
				if (is_string($model))
				{
					$result["response"] = $model;
				}
				else
				{
					$result["response"] = "error";
				}
			}
		}
		$this->response->body(json_encode($result));
	}
	
}
