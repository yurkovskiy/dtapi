<?php defined('SYSPATH') or die('No direct script access.');

/**
 * TestPlayer Controller
 *
 */

class Controller_TestPlayer extends Controller_Base {
	
	private $TEST_PLAYER_DATA = "TP_DATA";
	
	private $TEST_PLAYER_TIME = "TP_TIME";

	/**
	 * getTimeStamp - get current time from a server
	 */
	public function action_getTimeStamp()
	{
		$offset_sec = date("Z"); // offset in seconds depends on timezone
		$curtime = time() + $offset_sec; // current time depends on timezone
		$this->response->body(json_encode(array("unix_timestamp" => time(),"offset" => $offset_sec,"curtime" => $curtime), JSON_UNESCAPED_UNICODE));
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
		
		$value = @json_decode($this->request->body());
		if (is_null($value))
		{
			throw new HTTP_Exception_400("Wrong input data");
		}
		else 
		{
			// save data to the server storage
			$session->set($this->TEST_PLAYER_DATA, $value);
			$this->response->body(json_encode(array("response" => "Data has been saved"), JSON_UNESCAPED_UNICODE));
		}
		
	}
	
	/**
	 * @name getData - get user's custom data from session 
	 */
	public function action_getData()
	{
		$session = Session::instance();
		if (is_null($session->get($this->TEST_PLAYER_DATA)))
		{
			$this->response->body(json_encode(array("response" => "Empty slot"), JSON_UNESCAPED_UNICODE));
		}
		else 
		{
			$this->response->body(json_encode($session->get($this->TEST_PLAYER_DATA), JSON_UNESCAPED_UNICODE));
		}
		
	}
	
	/**
	 * @name saveEndTime - special method to save EndTime at the server's storage
	 * @return JSON
	 * @throws HTTP_Exception_400
	 */
	public function action_saveEndTime()
	{
		$session = Session::instance();
		$value = @json_decode($this->request->body());
		if (is_null($value))
		{
			throw new HTTP_Exception_400("Wrong input data");
		}
		else
		{
			if (!is_null($session->get($this->TEST_PLAYER_TIME)))
			{
				throw new HTTP_Exception_400("Time data is present. You cannot save time data twice");
			}
			else
			{
				// save time data to the server storage
				$session->set($this->TEST_PLAYER_TIME, $value);
				$this->response->body(json_encode(array("response" => "EndTime has been saved")));
			}
		}
	}
	
	/**
	 * @name getEndTime - get JSON representation of EndTime
	 */
	public function action_getEndTime()
	{
		$session = Session::instance();
		if (is_null($session->get($this->TEST_PLAYER_TIME)))
		{
			$this->response->body(json_encode(array("response" => "Empty slot"), JSON_UNESCAPED_UNICODE));
		}
		else
		{
			$this->response->body(json_encode($session->get($this->TEST_PLAYER_TIME)));
		}
	}
	
	/**
	 * @name resetSessionData - delete all session custom variables
	 */
	public function action_resetSessionData()
	{
		$session = Session::instance();
		$session->delete($this->TEST_PLAYER_DATA);
		$session->delete($this->TEST_PLAYER_TIME);
		$this->response->body(json_encode(array("response" => "Custom data has been deleted")));
	}
	
	/**
	 * method which is checking possibility to make a test by some user 
	 * using infromtation from timetables
	 * @return test entity or HTTP_400
	 * @throws HTTP_Exception_400
	 */
	public function action_getTest()
	{
		$test_id = $this->request->param("id");
		
		if (!isset($test_id) || (!is_numeric($test_id)) || ($test_id < 0))
		{
			throw new HTTP_Exception_400("Wrong input parameters");
		}
		
		$user_id = Auth::instance()->get_user()->id;
		
		// get group of student
		$group_id = null;
		$student = Model::factory("Student")->getRecord($user_id);
		
		foreach ($student as $record)
		{
			$group_id = $record->group_id;
		}
		unset($student);
		
		// get subject of test
		$subject_id = null;
		$test = Model::factory("Test")->getRecord($test_id);
		foreach ($test as $record)
		{
			$subject_id = $record->subject_id;
		}
		
		// check timetable
		$timetable_count = Model::factory("TimeTable")->getTimeTableForGroupAndSubject($group_id, $subject_id)->count()	;
		if ($timetable_count > 0)
		{
			// so we can return the test entity
			return $this->buildJSONResponse($test, Model::factory("Test")->getFieldNames());
		}
		else 
		{
			throw new HTTP_Exception_400("You don't have permissions to make this test");
		}		
	}

}
