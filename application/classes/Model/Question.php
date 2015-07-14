<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Question table model
 *
 */

class Model_Question extends Model_Common {
	
	protected $tableName = "questions";
	protected $fieldNames = array("question_id", "test_id", "question_text", "level", "type", "attachment");
	
}