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
	
	public function countTestPassesByStudent($student_id, $test_id)
	{
		$query = "SELECT COUNT(*) AS count FROM {$this->tableName} 
				  WHERE {$this->fieldNames[1]} = {$student_id} 
				  AND {$this->fieldNames[2]} = {$test_id}";
		$count = DB::query(Database::SELECT, $query)->execute()->get('count');
		return $count;
	}
	
}
