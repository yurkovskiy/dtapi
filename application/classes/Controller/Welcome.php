<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Faculty Controller for handle AJAX requests
 *
 */

class Controller_Welcome extends Controller {

	public function action_index() 
	{
		$this->response->body("Welcome to the D-Tester API");
	}

}