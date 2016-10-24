<?php

defined ('SYSPATH') or die ('No direct script access.');

/**
 * Login Controller for handle AJAX requests
 */
class Controller_Login extends Controller 
{
	private $RAW_DATA_SOURCE = "php://input";
	
	/**
	 *
	 * @name index - login action
	 * @return JSON - with user parameters (id, name, roles)
	 */
	public function action_index() 
	{
		$result = array();
		$params = @json_decode(file_get_contents($this->RAW_DATA_SOURCE));
		
		if (is_null($params)) 
		{
			throw new HTTP_Exception_400("Wrong request");
		} 
		else 
		{
			// check JSON keys 
			if (property_exists($params, "username") && (property_exists($params, "password"))) 
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
					throw new HTTP_Exception_400("Invalid login or password");
				}
			}
			else 
			{
				throw new HTTP_Exception_400("Wrong request");
			}
		}
		
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
	}
	
	public function action_logout() 
	{
		$result = Auth::instance()->logout(TRUE);
		if ($result)
		{
			$this->response->body(json_encode(array("response" => "user has been logout"), JSON_UNESCAPED_UNICODE));
		}
		else
		{
			throw new HTTP_Exception_400("Something wrong due to permorm logout action");
		}
	}
	
	/**
	 *
	 * @name isLogged - check if anyuser is logged
	 * @return boolean (JSON)
	 */
	public function action_isLogged() 
	{
		$result = null;
		if (Auth::instance()->logged_in()) 
		{
			$roles = Auth::instance()->get_user()->roles->find_all();
			foreach ($roles as $role) 
			{
				$result["roles"][] = $role->name;
			}
			$result["id"] = Auth::instance()->get_user()->id;
			$result["username"] = Auth::instance()->get_user()->username;
			$result["response"] = "logged";
		} 
		else 
		{
			$result["response"] = "non logged";
		}
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
	}
}
