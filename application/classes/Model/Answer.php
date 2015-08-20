<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Answer table model
 *
 */

class Model_Answer extends Model_Common {
	
	protected $tableName = "answers";
	protected $fieldNames = array("answer_id","question_id", "true_answer", "answer_text", "attachment");
	
	public function getAnswersByQuestion($question_id)
	{
		$query = DB::select_array($this->fieldNames)->from($this->tableName)->where($this->fieldNames[1], "=", $question_id)->order_by($this->fieldNames[0], 'asc');
		$result = $query->as_object()->execute();
		return $result;
	}
	
}
