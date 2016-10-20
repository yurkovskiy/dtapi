<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Specialities table model
 *
 */

class Model_Speciality extends Model_Common {
	
	protected $tableName = "specialities";
	protected $fieldNames = array("speciality_id", "speciality_code", "speciality_name");
	
	public function getRecordsBySearch($criteria)
	{
		return $this->getRecordsBySearchCriteria($this->fieldNames[2], $criteria);
	}
	
}
