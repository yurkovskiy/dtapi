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
		$offset_sec = date("Z"); // offset in seconds depends on timezone
		$curtime = time() + $offset_sec; // current time depends on timezone
		$this->response->body(json_encode(array("unix_timestamp" => time(),"offset" => $offset_sec,"curtime" => $curtime)));
	}

}
