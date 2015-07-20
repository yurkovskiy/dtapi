<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions TestDetail table model
 *
 */

class Model_TestDetail extends Model_Common {
	
	protected $tableName = "test_details";
	protected $fieldNames = array("id","test_id", "level", "tasks", "rate");
	
}