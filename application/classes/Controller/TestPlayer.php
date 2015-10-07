<?php defined('SYSPATH') or die('No direct script access.');

/**
 * TestPlayer Controller
 *
 */

class Controller_TestPlayer extends Controller_Base {

	/**
	 * getTimeStamp - get current time from a server
	 */
	public function action_getTimeStamp()
	{
		$curtime = time(); // current Unix timestamp
		$this->response->body(json_encode(array("curtime" => $curtime)));
	}

}
