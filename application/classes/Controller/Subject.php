<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Subject Controller for handle AJAX requests
 *
 */

class Controller_Subject extends Controller_BaseAdmin {
	
	public function action_getRecordsBySearch()
	{
		return $this->getRecordsBySearchCriteria();
	}
	
}
