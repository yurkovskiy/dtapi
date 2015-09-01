<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Test Controller for handle AJAX requests
 *
 */

class Controller_Test extends Controller_BaseAdmin {

	protected $modelName = "Test";
	
	public function action_getTestsBySubject()
	{
		$record_id = $this->request->param("id");
		$result = array();
		$DBResult = null;
		$DBResult = Model::factory($this->modelName)->getTestsBySubject($record_id);
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
	
	public function action_insertData()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to insert records");
		}
		else
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
				
				// Everything is OK, so we try to create a directory for test
				$TESTS_BASE_DIR = DOCROOT."tests";
				$directory_name = "test_".$model;
				
				$directory_name = $TESTS_BASE_DIR.DIRECTORY_SEPARATOR.$directory_name;
												
				$dir = @mkdir($directory_name);
				if (!$dir)
				{
					$result["directory"] = "Error: directory is not created";
				}
				else
				{
					$result["directory"] = "Success: directory has been created";
				}
				
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
		
	}
}
