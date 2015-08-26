<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Test Controller for handle AJAX requests
 *
 */

class Controller_Test extends Controller_BaseAdmin {

	protected $modelName = "Test";
	
	public function action_getTestsBySubject()
	{
		$record_id = $this->request->param("id");
		$result = array();
		$DBResult = null;
		$DBResult = Model::factory($this->modelName)->getTestsBySubject($record_id);
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
		$r = json_encode($result);
		$this->response->body($r);
	}
}
