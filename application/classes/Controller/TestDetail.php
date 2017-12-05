<?php defined('SYSPATH') or die('No direct script access.');

/**
 * TestDetail Controller for handle AJAX requests
 *
 */

class Controller_TestDetail extends Controller_BaseAdmin {

	public function action_getTestDetailsByTest()
	{
		return $this->getEntityRecordsBy("getTestDetailsByTest");
	}
	
}
