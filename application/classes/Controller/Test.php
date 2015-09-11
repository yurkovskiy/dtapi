<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Test Controller for handle AJAX requests
 *
 */

class Controller_Test extends Controller_BaseAdmin {

	protected $modelName = "Test";
	
	public function action_getTestsBySubject()
	{
		return $this->getEntityRecordsBy("getTestsBySubject");
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
