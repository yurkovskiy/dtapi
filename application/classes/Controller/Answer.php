<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Answer Controller for handle AJAX requests
 *
 */

class Controller_Answer extends Controller_BaseAdmin {

	protected $modelName = "Answer";
	
	public function before()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("Only Admins have ability to work with this Entity");
		}
		else
		{
			parent::before();
		}
	}
	
	public function action_getAnswersByQuestion()
	{
		return $this->getEntityRecordsBy("getAnswersByQuestion");
	}

}
