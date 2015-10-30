<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Test Controller for handle AJAX requests
 *
 */

class Controller_Test extends Controller_BaseAdmin {

	protected $modelName = "Test";
	
	public function action_getTestsBySubject()
	{
		return $this->getEntityRecordsBy("getTestsBySubject");
	}
	
}
