<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Answer [Student] table model
 *
 */

class Model_SAnswer extends Model_Common {
	
	protected $tableName = "answers";
	protected $fieldNames = array("answer_id","question_id", "answer_text", "attachment");
			
	// Mock register
	public function registerRecord($values)
	{
		return null;
	}
	
	// Mock update
	public function updateRecord($values)
	{
		return null;
	}
	
	// Mock erase
	public function eraseRecord($record_id)
	{
		return null;
	}
	
	public function getAnswersByQuestion($question_id)
	{
		return $this->getEntityBy($this->fieldNames[1], $question_id);
	}
	
}
