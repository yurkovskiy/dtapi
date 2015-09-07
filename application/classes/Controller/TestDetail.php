<?php defined('SYSPATH') or die('No direct script access.');

/**
 * TestDetail Controller for handle AJAX requests
 *
 */

class Controller_TestDetail extends Controller_BaseAdmin {

	protected $modelName = "TestDetail";
	
	public function action_getTestDetailsByTest()
	{
		$record_id = $this->request->param("id");
		$result = array();
		$DBResult = null;
		$DBResult = Model::factory($this->modelName)->getTestDetailsByTest($record_id);
		$fieldNames = Model::factory($this->modelName)->getFieldNames();
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
			$result[] = array('record_id', 'null');
		}

		$this->response->body(json_encode($result));
	}

}
