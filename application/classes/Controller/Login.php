<?php

defined ('SYSPATH') or die ('No direct script access.');

/**
 * Login Controller for handle AJAX requests
 */
class Controller_Login extends Controller 
{
	/**
	 *
	 * @name index - login action
	 * @return JSON - with user parameters (id, name, roles)
	 */
	public function action_index() 
	{
		$result = array();

		$params = @json_decode($this->request->body());
		
		if (is_null($params) || (!is_object($params))) 
		{
			throw new HTTP_Exception_400("Wrong request");
		} 
		else 
		{
			// check JSON keys 
			if (property_exists($params, "username") && (property_exists($params, "password"))) 
			{
				$success = null;
				try {
					$success = Auth::instance()->login($params->username, $params->password, FALSE);
				} catch (Exception $e) {
					throw new HTTP_Exception_400($e->getMessage());
				}
				
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
		$result = null;
		try {
			if (Auth::instance()->logged_in("login"))
			{
				try {
					$result = Auth::instance()->logout(TRUE);
				} catch (Session_Exception $e) {
					throw new HTTP_Exception_400($e->getMessage());
				}
				
				if ($result)
				{
					$this->response->body(json_encode(array("response" => "user has been logout"), JSON_UNESCAPED_UNICODE));
				}
				else
				{
					throw new HTTP_Exception_400("Something wrong due to permorm logout action");
				}
			}
			else
			{
				throw new HTTP_Exception_400("Cannot use this method due to not logged user");
			}
		} catch (Session_Exception $e) {
			throw new HTTP_Exception_400($e->getMessage());
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
