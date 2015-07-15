<?php defined('SYSPATH') or die('No direct script access.');

/**
 * BaseAjax Controller for handle AJAX requests [contain core methods]
 *
 */

abstract class Controller_BaseAjax extends Controller 
{

	protected $modelName = "";
	
	private $RAW_DATA_SOURCE = "php://input";
		
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
		// Read POST data in JSON format
		$params = json_decode(file_get_contents($this->RAW_DATA_SOURCE));
	
		// Convert Object into Array
		$paramsArr = get_object_vars($params);
		array_unshift($paramsArr, 0); // Add 0 value for autoincrement of Primary Key
			
		$values = array_values($paramsArr);
	
		$model = Model::factory($this->modelName)->registerRecord($values);
		if ($model)
		{
			// Creating response in JSON format
			$result["response"] = "ok";
		}
		else
		{
			$result["response"] = "error";
		}
		$r = json_encode($result);
		$this->response->body($r);
	
	}
	
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
		$record_id = $this->request->param("id");
		$results = array();
		
		// get info from client
		$params = json_decode(file_get_contents($this->RAW_DATA_SOURCE));
		$values = array_values(get_object_vars($params));
		
		array_unshift($values, $record_id); // Add record_id value for Primary Key
				
		// Give data to the Model
		$model = Model::factory($this->modelName)->updateRecord($values);
		if ($model)
		{
			// Creating response in JSON format
			$result["response"] = "ok";
		}
		else
		{
			$result["response"] = "error";
		}
		$r = json_encode($result);
		$this->response->body($r);
	}
	
	public function action_del()
	{
		$record_id = $this->request->param("id");
		$results = array();
		
		$model = Model::factory($this->modelName)->eraseRecord($record_id);
		if ($model)
		{
			// Creating response in JSON format
			$result["response"] = "ok";
		}
		else
		{
			$result["response"] = "error";
		}
		$r = json_encode($result);
		$this->response->body($r);
	}
	
}