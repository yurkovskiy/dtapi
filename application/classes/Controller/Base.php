<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Base Proxy Controller for handle AJAX requests
 *
 */

abstract class Controller_Base extends Controller {
	
	// Place where we read input data if POST
	protected $RAW_DATA_SOURCE = "php://input";

	/**
	 *
	 * @see Kohana_Controller::before()
	 * Auth control added
	 * Only logged users can work with entities
	 */
	/*public function before()
	{
		if (!Auth::instance()->logged_in("login"))
		{
			throw new HTTP_Exception_403("Only logged users can work with entities");
		}
		else
		{
			parent::before();
		}
	}*/
	
	/**
	 * @name action_index
	 * @return JSON - with CORE info about system
	 *
	 * This method for default action when the User define only Entity name in URL
	 *
	 */
	public function action_index()
	{
		$result = array("name" => "d-tester API",
				"author" => "Yuriy V. Bezgachnyuk aka Yurkovskiy",
				"date" => "20 Aug. 2015",
				"hint" => "Please define an action in URL address");
	
		$this->response->body(json_encode($result));
	}

}
