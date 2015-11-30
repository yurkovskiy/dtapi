<?php defined('SYSPATH') or die('No direct script access.');

/**
 * TestPlayer Controller
 *
 */

class Controller_TestPlayer extends Controller_Base {
	
	private $TEST_PLAYER_DATA = "TP_DATA";

	/**
	 * getTimeStamp - get current time from a server
	 */
	public function action_getTimeStamp()
	{
		$offset_sec = date("Z"); // offset in seconds depends on timezone
		$curtime = time() + $offset_sec; // current time depends on timezone
		$this->response->body(json_encode(array("unix_timestamp" => time(),"offset" => $offset_sec,"curtime" => $curtime)));
	}
	
	/**
	 * @name saveData - save JSON (or other) user's custom data to the server into session
	 * @access public
	 * @throws HTTP_Exception_400 - if the request data is not present
	 */
	public function action_saveData()
	{
		// get session object
		$session = Session::instance();
		
		$value = @json_decode(file_get_contents($this->RAW_DATA_SOURCE));
		if (is_null($value))
		{
			throw new HTTP_Exception_400("Wrong input data");
		}
		else 
		{
			// save data to the server storage
			$session->set($this->TEST_PLAYER_DATA, $value);
			$this->response->body(json_encode(array("response" => "Data has been saved")));
		}
		
	}
	
	/**
	 * @name getData - get user's custom data from session 
	 * @throws HTTP_Exception_404 - if the empty set
	 */
	public function action_getData()
	{
		$session = Session::instance();
		if (is_null($session->get($this->TEST_PLAYER_DATA)))
		{
			throw new HTTP_Exception_404("Empty set");
		}
		else 
		{
			$this->response->body(json_encode($session->get($this->TEST_PLAYER_DATA)));
		}
		
	}

}
