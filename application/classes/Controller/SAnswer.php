<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Answer [Student] Controller for handle AJAX requests
 *
 */

class Controller_SAnswer extends Controller_BaseAjax {

	protected $modelName = "SAnswer";
	
	public function action_insertData()
	{
		throw new HTTP_Exception_404("Not found for users");
	}
	
	public function action_update()
	{
		throw new HTTP_Exception_404("Not found for users");
	}
	
	public function action_del()
	{
		throw new HTTP_Exception_404("Not found for users");
	}
	
	public function action_getAnswersByQuestion()
	{
		return $this->getEntityRecordsBy("getAnswersByQuestion");
	}

}
