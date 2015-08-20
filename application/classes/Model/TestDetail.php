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
		$query = DB::select_array($this->fieldNames)->from($this->tableName)->where($this->fieldNames[1], "=", $test_id)->order_by($this->fieldNames[0], 'asc');
		$result = $query->as_object()->execute();
		return $result;
	}
	
}
