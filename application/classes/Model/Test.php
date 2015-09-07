<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Test table model
 *
 */

class Model_Test extends Model_Common {
	
	protected $tableName = "tests";
	protected $fieldNames = array("test_id", "test_name","subject_id", "tasks", "time_for_test", "enabled", "attempts");
	
	public function getTestsBySubject($subject_id)
	{
		return $this->getEntityBy($this->fieldNames[2], $subject_id);
	}
	
}
