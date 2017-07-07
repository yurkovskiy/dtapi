<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions TimeTable table model
 *
 */

class Model_TimeTable extends Model_Common {
	
	protected $tableName = "timetables";
	protected $fieldNames = array("timetable_id", "group_id","subject_id", "start_date", "start_time", "end_date", "end_time");
	
	/**
	 * 
	 * @param int $group_id
	 * @return MySQL ResultSet
	 */
	public function getTimeTablesForGroup($group_id)
	{
		return $this->getEntityBy($this->fieldNames[1], $group_id);
	}
	
	/**
	 * 
	 * @param int $subject_id
	 * @return MySQL ResultSet
	 */
	public function getTimeTablesForSubject($subject_id)
	{
		return $this->getEntityBy($this->fieldNames[2], $subject_id);		
	}
	
	public function getTimeTableForGroupAndSubject($group_id, $subject_id, $check_time = false)
	{
		$query = null;
		if ($check_time)
		{
			$query = DB::select_array($this->fieldNames)
			->from($this->tableName)
			->where($this->fieldNames[1], "=", $group_id)
			->and_where($this->fieldNames[2], "=", $subject_id)
			->and_where(DB::expr("CONCAT({$this->fieldNames[3]}, ' ', {$this->fieldNames[4]})"), "<=", DB::expr("NOW()"))
			->and_where(DB::expr("CONCAT({$this->fieldNames[5]}, ' ', {$this->fieldNames[6]})"), ">=", DB::expr("NOW()"));
		}
		
		else 
		{
			$query = DB::select_array($this->fieldNames)
			->from($this->tableName)
			->where($this->fieldNames[1], "=", $group_id)
			->and_where($this->fieldNames[2], "=", $subject_id);
		}
				
		$result = $query->as_object()->execute();
		return $result;
	}
	
}
