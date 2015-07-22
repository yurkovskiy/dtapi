<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Faculty Controller for handle AJAX requests
 *
 */

class Controller_Welcome extends Controller {

	public function action_index() 
	{
		$this->response
			->send_headers("Cache-Control: no-cache, no-store, must-revalidate", "Pragma: no-cache", "Expires: 0")
			->body("Welcome to the D-Tester API");
	}

}