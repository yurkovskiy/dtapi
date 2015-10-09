<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Log Controller for handle AJAX requests
 *
 */

class Controller_Log extends Controller_BaseAjax {

	protected $modelName = "Log";
	
	protected $ADMIN_ROLE = "admin";
		
	public function action_update()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to update records");
		}
		else
		{
			parent::action_update();
		}
	}
	
	public function action_del()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to erase records");
		}
		else
		{
			parent::action_del();
		}
	}
	
	public function action_getLogsByUser()
	{
		return $this->getEntityRecordsBy("getLogsByUser");
	}
	
}
