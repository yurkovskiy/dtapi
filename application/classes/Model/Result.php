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
		$query = "SELECT COUNT({$this->fieldNames[0]}) AS count FROM {$this->tableName} 
				  WHERE {$this->fieldNames[1]} = {$student_id} 
				  AND {$this->fieldNames[2]} = {$test_id}";
		$count = DB::query(Database::SELECT, $query)->execute()->get('count');
		return $count;
	}
	
	public function getResultsByTestAndGroup($test_id, $group_id = null, $tdate = null)
	{
		$query = DB::select_array($this->fieldNames)
			->from($this->tableName)
			->where($this->fieldNames[2], "=", $test_id);
		
		if ((!is_null($group_id)) && ($group_id != 0))
		{
			$query->and_where($this->fieldNames[1], "IN", DB::expr("(SELECT user_id FROM students WHERE group_id = {$group_id})"));
		}
		
		if (!is_null($tdate))
		{
			$query->and_where($this->fieldNames[3], "=", $tdate);
		}
		
		$result = $query->as_object()->execute();
		return $result;
	}
	
	public function getResultTestIdsByGroup($group_id)
	{
		$query = DB::select($this->fieldNames[2])
			->distinct(TRUE)
			->from($this->tableName)
			->where($this->fieldNames[1], "IN", DB::expr("(SELECT user_id FROM students WHERE group_id = {$group_id})"));
		
		$result = $query->as_object()->execute();
		return $result;
	}
	
}
