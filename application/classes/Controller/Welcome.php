<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Welcome Controller
 *
 */

class Controller_Welcome extends Controller {

	public function action_index() 
	{
		$result = array("name" => "d-tester API",
				"author" => "Yuriy V. Bezgachnyuk aka Yurkovskiy",
				"startdate" => "20 Aug. 2015");
		
		$this->response
			->send_headers("Cache-Control: no-cache, no-store, must-revalidate", "Pragma: no-cache", "Expires: 0", "Content-Type: application/json;charset=utf-8")
			->body(json_encode(array("response" => "Welcome to the D-Tester API version 2.1", "systeminfo" => $result)));
	}

}
