<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Answer Controller for handle AJAX requests
 *
 */

class Controller_Answer extends Controller_BaseAdmin {

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
	
	/**
	 * Should be mocked, because a lot of records in DB present
	 * Please use getRecordsRange only
	 * @see Controller_BaseAjax::action_getRecords()
	 */
	public function action_getRecords()
	{
		$record_id = $this->request->param("id");
		if (isset($record_id))
		{
			parent::action_getRecords();
		}
		else 
		{
			throw new HTTP_Exception_400("This method allowed for gathering one record only");
		}
	}
	
	public function action_getAnswersByQuestion()
	{
		$without_images = $this->request->param("id1");
		if (!is_null($without_images))
		{
			return $this->getEntityRecordsBy("getAnswersByQuestion", Model::factory($this->modelName)->getFieldNames_());
		}
		return $this->getEntityRecordsBy("getAnswersByQuestion");
	}

}
