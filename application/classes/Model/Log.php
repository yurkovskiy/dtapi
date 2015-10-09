<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Logs table model
 *
 */

class Model_Log extends Model_Common {
	
	protected $tableName = "logs";
	protected $fieldNames = array("log_id","user_id", "test_id", "log_date", "log_time");

	public function getLogsByUser($user_id)
	{
		return $this->getEntityBy($this->fieldNames[1], $user_id);
	}
	
}
