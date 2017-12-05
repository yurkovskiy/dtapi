<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Faculty Controller for handle AJAX requests
 *
 */

class Controller_Faculty extends Controller_BaseAdmin {

	public function action_getRecordsBySearch()
	{
		return $this->getRecordsBySearchCriteria();
	}

}
