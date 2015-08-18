<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Login Controller for handle AJAX requests
 *
 */

class Controller_Login extends Controller {
	
	private $RAW_DATA_SOURCE = "php://input";

	public function action_index()
	{
		$result = array();
		$params = json_decode(file_get_contents($this->RAW_DATA_SOURCE));
		$success = Auth::instance()->login($params->username, $params->password, FALSE);
		if ($success)
		{
			// get username
			$userName = Auth::instance()->get_user()->username;
			// get user roles
			$roles = Auth::instance()->get_user()->roles->find_all();
			foreach ($roles as $role)
			{
				$result["roles"][] = $role->name;								
			}
			
			$result["username"] = $userName;
												
			$result["response"] = "ok";
		}
		else 
		{
			$result["response"] = "Invalid login or password";
		}
		
		$this->response->body(json_encode($result));
	}
	
	public function action_logout()
	{
		Auth::instance()->logout(TRUE);
	}

}