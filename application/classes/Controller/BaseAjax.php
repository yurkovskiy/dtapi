<?php defined('SYSPATH') or die('No direct script access.');

/**
 * BaseAjax Controller for handle AJAX requests [contain core methods]
 *
 */

abstract class Controller_BaseAjax extends Controller 
{

	protected $modelName = "";
		
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
		$results = array();
		$Model = Model::factory($this->modelName);
		$DBResult = null;
		if (!isset($record_id)) 
		{
			$DBResult = $Model->getRecords();
		}
		else 
		{
			$DBResult = $Model->getRecord($record_id);
		}
		
		$fieldNames = $Model->getFieldNames();
		$results = array();
		foreach ($DBResult as $data)
		{
			$item = array();
			foreach ($fieldNames as $fieldName) {
				$item[$fieldName] = $data->$fieldName;
			}
			array_push($results, $item);
		}
		if (sizeof($results) < 1)
		{
			$results[] = array('record_id', 'null');
		}
		$r = json_encode($results);
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
		$values = array();
		// Read POST data in JSON format
		$params = json_decode(file_get_contents("php://input"));
	
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
	
}