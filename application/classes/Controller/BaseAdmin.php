<?php defined('SYSPATH') or die('No direct script access.');

/**
 * BaseAdmin Controller Proxy for Admin side of the system for handle AJAX requests
 * 
 * Proxy class for Admin. Only admin users can add/edit/delete entities (basicaly)
 *
 */

abstract class Controller_BaseAdmin extends Controller_BaseAjax {
	
	public function action_insertData()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to insert records");
		}
		else 
		{
			parent::action_insertData();
		}
	}
	
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

}
