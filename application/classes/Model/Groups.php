<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Groups table model
 *
 */

class Model_Groups extends Model_Common {
	
	protected $tableName = "groups";
	protected $fieldNames = array("group_id", "group_name", "speciality_id", "faculty_id");
	
}