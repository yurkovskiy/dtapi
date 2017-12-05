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
	
}
