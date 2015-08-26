<?php defined('SYSPATH') or die('No direct script access.');

/**
 * BaseAjax Controller for handle AJAX requests [contain core methods]
 *
 */

abstract class Controller_BaseAjax extends Controller 
{
	
	// Model for Controller that will be given in child classes 
	protected $modelName = "";
	
	protected $RAW_DATA_SOURCE = "php://input";
	
	public function before()
	{
		if (!Auth::instance()->logged_in("login"))
		{
			throw new HTTP_Exception_403("You don't have permissions to insert records");
		}
		else 
		{
			parent::before();
		}
	}
	
	/**
	 * @name action_index
	 * 
	 * This method for default action when the User define only Entity name in URL
	 * 
	 */
	public function action_index()
	{
		$result = array("name" => "d-tester API", 
				"author" => "Yuriy V. Bezgachnyuk aka Yurkovskiy", 
				"date" => "20 Aug. 2015", 
				"hint" => "Please define an action in URL address");
		
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
		if (!isset($record_id)) 
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
		$r = json_encode($result);
		$this->response->body($r);
	
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
		if ((!is_numeric($limit)) || (!is_numeric($offset)))
		{
			$result["response"] = "error";
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
		$r = json_encode($result);
		$this->response->body($r);
	}
	
	/**
	 * Return number of Records in table (for pagination)
	 */
	public function action_countRecords()
	{
		$numberOfRecords = Model::factory($this->modelName)->countRecords();
		$result = array();
		$result["numberOfRecords"] = $numberOfRecords;
		$r = json_encode($result);
		$this->response->body($r);
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
		$r = json_encode($result);
		$this->response->body($r);
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
		$results = array();
		$model = null;
		
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
		$r = json_encode($result);
		$this->response->body($r);
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
		$r = json_encode($result);
		$this->response->body($r);
	}
	
}
