<?php defined('SYSPATH') or die('No direct script access.');

/**
 * TimeTable Controller for handle AJAX requests
 *
 */

class Controller_TimeTable extends Controller_BaseAdmin {

	protected $modelName = "TimeTable";
	
	public function action_getTimeTablesFromNowInMonth()
	{
		$result = array();
		$user_id = Auth::instance()->get_user()->id;
		$DBResult = Model::factory($this->modelName)->getTimeTablesFromNowInMonth($user_id);
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
			$result["response"] = "No records";
		}
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
		
	}
	
	public function action_getTimeTablesForGroup()
	{
		return $this->getEntityRecordsBy("getTimeTablesForGroup");
	}
	
	public function action_getTimeTablesForSubject()
	{
		return $this->getEntityRecordsBy("getTimeTablesForSubject");
	}
	
}
