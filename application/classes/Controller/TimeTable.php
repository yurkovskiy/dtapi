<?php defined('SYSPATH') or die('No direct script access.');

/**
 * TimeTable Controller for handle AJAX requests
 *
 */

class Controller_TimeTable extends Controller_BaseAdmin {

	public function action_getTimeTablesForGroup()
	{
		return $this->getEntityRecordsBy("getTimeTablesForGroup");
	}
	
	public function action_getTimeTablesForSubject()
	{
		return $this->getEntityRecordsBy("getTimeTablesForSubject");
	}
	
	public function action_getTimeTableForGroupAndSubject()
	{
		$group_id = $this->request->param("id");
		$subject_id = $this->request->param("id1");
		
		if ((!is_numeric($group_id)) || (!is_numeric($subject_id)) || ($group_id < 0) || ($subject_id < 0))
		{
			throw new HTTP_Exception_400("Wrong request");
		}
		else 
		{
			$DBResult = Model::factory($this->modelName)->getTimeTableForGroupAndSubject($group_id, $subject_id);
			$fieldNames = Model::factory($this->modelName)->getFieldNames();
			$this->buildJSONResponse($DBResult, $fieldNames);
		}
	}
	
}
