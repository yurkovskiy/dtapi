<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Groups table model
 *
 */

class Model_Group extends Model_Common {
	
	protected $tableName = "groups";
	protected $fieldNames = array("group_id", "group_name", "speciality_id", "faculty_id");
	
	public function getGroupsBySpeciality($speciality_id)
	{
		return $this->getEntityBy($this->fieldNames[2], $speciality_id);
	}
	
	public function getGroupsByFaculty($faculty_id)
	{
		return $this->getEntityBy($this->fieldNames[3], $faculty_id);
	}
	
	public function getRecordsBySearch($criteria)
	{
		return $this->getRecordsBySearchCriteria($this->fieldNames[1], $criteria);
	}
	
}
