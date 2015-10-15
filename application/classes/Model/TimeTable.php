<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions TimeTable table model
 *
 */

class Model_TimeTable extends Model_Common {
	
	protected $tableName = "timetables";
	protected $fieldNames = array("timetable_id", "group_id","subject_id", "event_date");
	
	/**
	 * @name getTimeTablesForThreeMonth
	 * @access public
	 * @return MySQL ResultSet
	 * 
	 * Return records from $this->timetable if event_date is suitable CURDATE() AND CURDATE() + 1 MONTH
	 */
	public function getTimeTablesFromNowInMonth($user_id)
	{
		$query = null;
		$group_id = null;
		
		// check user and find out group_id
		$student = Model::factory("Student")->getRecord($user_id);
		foreach ($student as $record)
		{
			$group_id = $record->group_id;
		}

		if (is_null($group_id)) 
		{
			$query = DB::select_array($this->fieldNames)
				->from($this->tableName)
				->where($this->fieldNames[3], ">=", DB::expr("CURDATE()"))
				->and_where($this->fieldNames[3], "<=", DB::expr("DATE_ADD(CURDATE(), INTERVAL 1 MONTH)"))
				->order_by($this->fieldNames[0], 'asc');
		}
		else 
		{
			$query = DB::select_array($this->fieldNames)
				->from($this->tableName)
				->where($this->fieldNames[1], "=", $group_id)
				->and_where($this->fieldNames[3], ">=", DB::expr("CURDATE()"))
				->and_where($this->fieldNames[3], "<=", DB::expr("DATE_ADD(CURDATE(), INTERVAL 1 MONTH)"))
				->order_by($this->fieldNames[0], 'asc');
		}
		
		$result = $query->as_object()->execute();
		return $result;
	}
	
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
	
}
