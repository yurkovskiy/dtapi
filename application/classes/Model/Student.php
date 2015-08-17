<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Students table model
 *
 */

class Model_Student extends Model_Common {
	
	protected $tableName = "students";
	protected $fieldNames = array("user_id", "gradebook_id","student_surname", "student_name", "student_fname","group_id");
	
	public function registerRecord($values)
	{
		// first we need register user account uses User Model for future Auth
	}
	
}