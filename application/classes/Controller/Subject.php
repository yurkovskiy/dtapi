<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Subject Controller for handle AJAX requests
 *
 */

class Controller_Subject extends Controller_BaseAdmin {
	
	protected $modelName = "Subject";
	
	public function action_getRecordsBySearch()
	{
		$criteria = $this->request->param("id");
		$result = array();
		$fieldNames = Model::factory($this->modelName)->getFieldNames();
		$DBResult = Model::factory($this->modelName)->getRecordsBySearch($criteria);
		
		foreach ($DBResult as $data)
		{
			$item = array();
			foreach ($fieldNames as $fieldName) {
				$item[$fieldName] = $data->$fieldName;
			}
			array_push($result, $item);
		}
		if (sizeof($result) < 1)
		{
			$result["response"] = "no records";
		}
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
	}
	
}
