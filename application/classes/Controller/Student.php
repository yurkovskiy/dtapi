<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Student Controller for handle AJAX requests
 *
 */

class Controller_Student extends Controller_BaseAdmin {

	protected $modelName = "Student";
	
	public function action_insertData()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to insert records");
		}
		else 
		{
			$result = array();
			// Read POST data in JSON format
			$params = json_decode(file_get_contents($this->RAW_DATA_SOURCE));
			
			// Convert Object into Array
			$paramsArr = get_object_vars($params);
									
			//$values = array_values($paramsArr);
			$values = $paramsArr;
			
			$model = Model::factory($this->modelName)->registerRecord($values);
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
	}
	
	public function action_getStudentsByGroup()
	{
		$record_id = $this->request->param("id");
		$result = array();
		$DBResult = null;
		$DBResult = Model::factory($this->modelName)->getStudentsByGroup($record_id);
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

}
