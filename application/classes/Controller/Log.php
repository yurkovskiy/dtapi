<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Log Controller for handle AJAX requests
 *
 */

class Controller_Log extends Controller_BaseAjax {

	protected $modelName = "Log";
	
	protected $ADMIN_ROLE = "admin";
	
	public function action_insertData()
	{
		throw new HTTP_Exception_404("Not found for this Entity");
	}
		
	public function action_update()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to update records");
		}
		else
		{
			parent::action_update();
		}
	}
	
	public function action_del()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to erase records");
		}
		else
		{
			parent::action_del();
		}
	}
	
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
