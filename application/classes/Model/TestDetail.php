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

	public function getTestRate($test_id)
	{
		$rate = 0; // accumulator
		$test_details = $this->getTestDetailsByTest($test_id);
		foreach ($test_details as $test_detail)
		{
			$rate += intval($test_detail->tasks) * intval($test_detail->rate);
		}
		if ($rate === 0)
		{
			throw new HTTP_Exception_400("Probably test with id: {$test_id} does not present or does not have any parameter records");
		}
		unset($test_details);
		return $rate;
	}
}
