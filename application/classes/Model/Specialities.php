<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Specialities table model
 *
 */

class Model_Specialities extends Model_Common {
	
	protected $tableName = "specialities";
	protected $fieldNames = array("speciality_id", "speciality_code", "speciality_name");
	
}