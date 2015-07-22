<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @author Yuriy Bezgachnyuk
 * Class for generation custom response for HTTP 403 Exception in JSON format
 *
 */

class HTTP_Exception_403 extends Kohana_HTTP_Exception_403 {
	
	public function get_response()
	{
		$response = Response::factory()
			->status($this->_code)
			->send_headers("Content-Type: application/json")
			->body(json_encode(array("response" => $this->getMessage())));
		
		return $response;
	}	
}

