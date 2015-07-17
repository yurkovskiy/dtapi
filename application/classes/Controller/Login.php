<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Answer Controller for handle AJAX requests
 *
 */

class Controller_Login extends Controller {

	public function action_index()
	{
		$sucsses = Auth::instance()->login("admin", "dtapi_admin", FALSE);
		var_dump($sucsses);
	}
	
	public function action_logout()
	{
		Auth::instance()->logout();
	}

}