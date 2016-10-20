<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Subject table model
 *
 */

class Model_Subject extends Model_Common {
	
	protected $tableName = "subjects";
	protected $fieldNames = array("subject_id", "subject_name", "subject_description");
	
	public function getRecordsBySearch($criteria)
	{
		return $this->getRecordsBySearchCriteria($this->fieldNames[1], $criteria);
	}
	
}
