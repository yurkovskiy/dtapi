<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Students table model
 *
 */

class Model_Student extends Model_Common {
	
	protected $tableName = "students";
	protected $fieldNames = array("student_id", "gradebook_id","student_surname", "student_name", "student_fname","group_id");
	
}