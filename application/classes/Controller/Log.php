<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Log Controller for handle AJAX requests
 *
 */

class Controller_Log extends Controller_BaseAdmin {

	protected $modelName = "Log";
			
	public function action_startTest()
	{
		$user_id = $this->request->param("id");
		$test_id = $this->request->param("id1");
		$model = Model::factory($this->modelName)->startTest($user_id, $test_id);
		
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
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
	}
	
	public function action_getLogsByUser()
	{
		return $this->getEntityRecordsBy("getLogsByUser");
	}
	
}
