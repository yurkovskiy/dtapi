<?php defined('SYSPATH') or die('No direct script access.');

/**
 * BaseAjax Controller for handle AJAX requests [contain core methods]
 *
 */

abstract class Controller_BaseAjax extends Controller_Base {
	
	// Model for Controller (has the name whis is the same as Controller name) 
	protected $modelName = "";
	
	/**
	 * 
	 * using binding for generate modelName which is the same as Controller name
	 * allow to avoid assignment in subclasses
	 */
	public function before()
	{
		$this->modelName = preg_split("/_/", get_class($this))[1];
		parent::before();
	}
									
	/**
	 * Helper method for refactoring
	 * @name getEntityRecordsBy
	 * @param String $modelMethod
	 */
	protected function getEntityRecordsBy($modelMethod, $fieldNames = null)
	{
		$record_id = $this->request->param("id");
		
		// little reflection :-)
		$DBResult = Model::factory($this->modelName)->{$modelMethod}($record_id);
		
		if (is_null($fieldNames))
		{
			$fieldNames = Model::factory($this->modelName)->getFieldNames();
		}
		
		$this->buildJSONResponse($DBResult, $fieldNames);
	}
	
	/**
	 * 
	 * @param JSON $paramObject
	 * @return bool
	 * 
	 */
	protected function checkInputParams($paramObject)
	{
		if (is_null($paramObject) || (!is_object($paramObject)))
		{
			return false;
		}
		return true;
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
		
		$this->buildJSONResponse($DBResult, $fieldNames);
	
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
		
		// additional features [sorting by parameter]
		$field = $this->request->param("id2");
		$direction = $this->request->param("id3");
		
		$DBResult = null;
				
		// check input parameters
		if ((!is_numeric($limit)) || (!is_numeric($offset)) || ($limit < 0) || ($offset < 0))
		{
			throw new HTTP_Exception_400("Wrong request");
		}
		else 
		{
			$DBResult = Model::factory($this->modelName)->getRecordsRange($limit, $offset, $field, $direction);
			$fieldNames = Model::factory($this->modelName)->getFieldNames();
			
			$this->buildJSONResponse($DBResult, $fieldNames);			
		}
	}
	
	
	/**
	 * @name getRecordsBySearchCriteria
	 * @access protected
	 * Basic search functionality
	 */
	protected function getRecordsBySearchCriteria()
	{
		$criteria = $this->request->param("id");
		$fieldNames = Model::factory($this->modelName)->getFieldNames();
		$DBResult = Model::factory($this->modelName)->getRecordsBySearch($criteria);
	
		$this->buildJSONResponse($DBResult, $fieldNames);
	}
	
	/**
	 * Return number of Records in table (for pagination)
	 * @return JSON object 
	 */
	public function action_countRecords()
	{
		$numberOfRecords = Model::factory($this->modelName)->countRecords();
		$this->response->body(json_encode(array("numberOfRecords" => $numberOfRecords), JSON_UNESCAPED_UNICODE));
	}
	
	/**
	 * Return the number of last record ID of some Entity
	 * @return JSON object
	 */
	public function action_getLastRecordId()
	{
		$lastRecordId = Model::factory($this->modelName)->getLastRecordId();
		$this->response->body(json_encode(array("lastRecordId" => $lastRecordId), JSON_UNESCAPED_UNICODE));
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
		$params = @json_decode($this->request->body());
		
		// check if input data is given
		if (!$this->checkInputParams($params))
		{
			throw new HTTP_Exception_400("No input data");
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
			// Good Result
			$DBResult = Model::factory($this->modelName)->getRecord($model);
			$fieldNames = Model::factory($this->modelName)->getFieldNames();
			$this->buildJSONResponse($DBResult, $fieldNames);
			return;
		}
		else
		{
			if (is_string($model))
			{
				$result["response"] = $model;
			}
			else
			{
				throw new HTTP_Exception_400("Error when insert");
			}
				
		}
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
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
			throw new HTTP_Exception_400("Wrong request");
		}
		else 
		{
			// Get data from JSON
			$params = @json_decode($this->request->body());
					
			// check if input data is given
			if (!$this->checkInputParams($params))
			{
				throw new HTTP_Exception_400("No input data");
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
				// Good Result
				$DBResult = Model::factory($this->modelName)->getRecord($record_id);
				$fieldNames = Model::factory($this->modelName)->getFieldNames();
				$this->buildJSONResponse($DBResult, $fieldNames);
				return;
			}
			else
			{
				if (is_string($model))
				{
					$result["response"] = $model;
				}
				else
				{
					throw new HTTP_Exception_400("Error when update");
				}
			}
		}
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
	}
	
	/**
	 * @name action_del
	 * @author Yuriy Bezgachnyuk
	 * @access public
	 * @method GET / DELETE
	 * 
	 * Delete information about Entity from database
	 * Using unique record_id for this action 
	 * 
	 */
	public function action_del()
	{
		$record_id = $this->request->param("id");
		$result = array();
		
		// check URL parameters
		if ((!isset($record_id)) || (!is_numeric($record_id)) || ($record_id <= 0))
		{
			throw new HTTP_Exception_400("Wrong request");
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
					throw new HTTP_Exception_400("Error when erase");
				}
			}
		}
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
	}
	
}
