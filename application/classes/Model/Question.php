<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Question table model
 *
 */

class Model_Question extends Model_Common {
	
	protected $tableName = "questions";
	protected $fieldNames = array("question_id", "test_id", "question_text", "level", "type", "attachment");
	
	public function getQuestionsByLevelRand($test_id, $level, $number)
	{
		$query = DB::select_array($this->fieldNames)->from($this->tableName)
				->where($this->fieldNames[1], "=", $test_id)
				->and_where($this->fieldNames[3], "=", $level)
				->order_by("", 'RAND()')
				->limit($number);
		$result = $query->as_object()->execute();
		return $result;
	}
	
}