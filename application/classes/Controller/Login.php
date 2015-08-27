<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Login Controller for handle AJAX requests
 *
 */

class Controller_Login extends Controller {
	
	private $RAW_DATA_SOURCE = "php://input";

	/**
	 * @name index - login action
	 * @return JSON - with user parameters (id, name, roles)
	 */
	public function action_index()
	{
		$result = array();
		$params = @json_decode(file_get_contents($this->RAW_DATA_SOURCE));
		
		if (is_null($params))
		{
			$result["response"] = "Error: No input data";
		}
		else
		{
		
			$success = Auth::instance()->login($params->username, $params->password, FALSE);
			if ($success)
			{
				// extract user's inforamtion
				$roles = Auth::instance()->get_user()->roles->find_all();
				foreach ($roles as $role)
				{
					$result["roles"][] = $role->name;								
				}
				
				$result["id"] = Auth::instance()->get_user()->id;
				$result["username"] = Auth::instance()->get_user()->username;
													
				$result["response"] = "ok";
			}
			else 
			{
				$result["response"] = "Invalid login or password";
			}
		}
		
		$this->response->body(json_encode($result));
		
	}
	
	public function action_logout()
	{
		Auth::instance()->logout(TRUE);
	}
	
	/**
	 * @name isLogged - check if anyuser is logged
	 * @return boolean (JSON)
	 */
	public function action_isLogged()
	{
		$result = null;
		if (Auth::instance()->logged_in())
		{
			$result["response"] = "logged";
		}
		else
		{
			$result["response"] = "non logged";
		}
		$this->response->body(json_encode($result));
	}

}
