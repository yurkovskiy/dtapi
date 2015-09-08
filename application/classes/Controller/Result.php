<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Result Controller for handle AJAX requests
 *
 */

class Controller_Result extends Controller_BaseAjax {

	protected $modelName = "Result";
	
	public function action_update()
	{
		// nothing to do :-)
		$this->response->body(json_decode(array("response" => "error")));
	}
	
	public function action_getRecordsByStudent()
	{
		return $this->getEntityRecordsBy("getResultByStudent");
	}

}
