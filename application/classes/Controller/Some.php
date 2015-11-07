<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Some Test [REST] 
 *
 */

class Controller_Some extends Controller_REST {
	
	protected function action_index() 
	{
		$this->response->body(json_encode(array("index" => "info from INDEX action")));
	}
	
	protected function action_create()
	{
		print_r($this->_params);
		$this->response->body(json_encode(array("create" => "info from CREATE action")));
	}
	
	protected function action_update()
	{
		print_r($this->_params);
		$this->response->body(json_encode(array("update" => "info from UPDATE action")));
	}
	
	protected function action_delete()
	{
		$this->response->body(json_encode(array("delete" => "info from DELETE action")));
	}

}
