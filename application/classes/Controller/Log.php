<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Log Controller for handle AJAX requests
 *
 */

class Controller_Log extends Controller_BaseAdmin {

	public function action_startTest()
	{
		$user_id = $this->request->param("id");
		$test_id = $this->request->param("id1");
		
		// Check input parameters
		if ((is_null($user_id)) || (is_null($test_id)))
		{
			throw new HTTP_Exception_400("This request require some input parameters");
		}
		
		// Strong check
		// Security checking: Student can start test only for himself
		if (Auth::instance()->logged_in($this->STUDENT_ROLE))
		{
			if ($user_id != Auth::instance()->get_user()->id)
			{
				throw new HTTP_Exception_403("You can start tests which are only for you!!!");
			}
		}
		else 
		{
			throw new HTTP_Exception_403("Only students can make a test");
		}
		
		// check Session. User cannot run this method twice before checkAnswers
		if (!is_null(Session::instance()->get("startTime")))
		{
			throw new HTTP_Exception_400("User is making test at current moment");
		}
		
		$model = Model::factory($this->modelName)->startTest($user_id, $test_id, Request::$client_ip);
		
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
