<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Speciality Controller for handle AJAX requests
 *
 */

class Controller_Speciality extends Controller_BaseAdmin {

	public function action_getRecordsBySearch()
	{
		return $this->getRecordsBySearchCriteria();
	}
	
}
