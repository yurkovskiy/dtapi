<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Widget table model
 *
 */

class Model_Widget extends Model_Common {
	
	protected $tableName = "widgets";
	protected $fieldNames = array("widget_id", "widget_name", "widget_data");
	
}
