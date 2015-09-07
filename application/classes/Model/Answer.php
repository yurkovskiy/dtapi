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
		return $this->getEntityBy($this->fieldNames[1], $question_id);
	}
	
}
