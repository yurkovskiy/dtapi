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
		$record_id = $this->request->param("id");
		$result = array();
		$DBResult = null;
		$DBResult = Model::factory($this->modelName)->getResultByStudent($record_id);
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
