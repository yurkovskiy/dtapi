<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Faculty table model
 *
 */

class Model_Faculty extends Model_Common {
	
	protected $tableName = "faculties";
	protected $fieldNames = array("faculty_id", "faculty_name", "faculty_description");
	
	public function getRecordsBySearch($criteria)
	{
		return $this->getRecordsBySearchCriteria($this->fieldNames[1], $criteria);
	}
	
}
