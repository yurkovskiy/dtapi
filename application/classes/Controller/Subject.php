<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Subject Controller for handle AJAX requests
 *
 */

class Controller_Subject extends Controller_BaseAdmin {
	
	protected $modelName = "Subject";
	
	public function action_getRecordsBySearch()
	{
		return $this->action_getRecordsBySearchCriteria();
	}
	
}
