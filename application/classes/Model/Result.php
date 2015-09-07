<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Result table model
 *
 */

class Model_Result extends Model_Common {
	
	protected $tableName = "results";
	protected $fieldNames = array("session_id", "student_id", "test_id", "session_date", "start_time", "end_time", "result", "questions", "true_answers", "answers");
	
	public function getResultByStudent($student_id)
	{
		return $this->getEntityBy($this->fieldNames[1], $student_id);
	}
	
}
