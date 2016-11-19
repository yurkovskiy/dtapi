<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions TestDetail table model
 *
 */

class Model_TestDetail extends Model_Common {
	
	protected $tableName = "test_details";
	protected $fieldNames = array("id","test_id", "level", "tasks", "rate");
	
	public function getTestDetailsByTest($test_id)
	{
		return $this->getEntityBy($this->fieldNames[1], $test_id);
	}
	
	public function getRateByTestAndLevel($test_id, $level)
	{
		$query = DB::select($this->fieldNames[4])
			->from($this->tableName)
			->where($this->fieldNames[1], "=", $test_id)
			->and_where($this->fieldNames[2], "=", $level);
		$result = $query->as_object()->execute();
		return $result;
	}
	
}
