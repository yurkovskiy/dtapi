<?php defined('SYSPATH') or die('No direct script access.');

/**
 * BaseAjax Controller for handle AJAX requests [contain core methods]
 *
 */

abstract class Controller_BaseAjax extends Controller 
{

	protected $modelName = "";

	public function action_getRecords() 
	{

		$record_id = $this->request->param("id");			
		$results = array();
		$Model = Model::factory($this->modelName);
		$DBResult = null;
		if (!isset($record_id)) 
		{
			$DBResult = $Model->getRecords();
		}
		else 
		{
			$DBResult = $Model->getRecord($record_id);
		}
		
		$fieldNames = $Model->getFieldNames();
		$results = array();
		foreach ($DBResult as $data)
		{
			$item = array();
			foreach ($fieldNames as $fieldName) {
				$item[$fieldName] = $data->$fieldName;
			}
			array_push($results, $item);
		}
		if (sizeof($results) < 1)
		{
			$results[] = array('record_id', 'null');
		}
		$r = json_encode($results);
		$this->response->body($r);
	
	}

}