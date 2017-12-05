<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Group Controller for handle AJAX requests
 *
 */

class Controller_Group extends Controller_BaseAdmin {

	public function action_getGroupsBySpeciality()
	{
		return $this->getEntityRecordsBy("getGroupsBySpeciality");
	}
	
	public function action_getGroupsByFaculty()
	{
		return $this->getEntityRecordsBy("getGroupsByFaculty");
	}
	
	public function action_getRecordsBySearch()
	{
		return $this->getRecordsBySearchCriteria();
	}
	
}
