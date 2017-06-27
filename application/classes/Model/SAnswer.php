<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Answer [Student] table model
 *
 */

class Model_SAnswer extends Model_Common implements Question {
	
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
	
	/**
	 * [SECURITY] for some question type we assume that all answers which
	 * are assigned for the question - true answers (QTYPE_INPUT_FIELD)
	 * so we cannot show the answers to the student as with questions with type (QTYPE_XXXX_CHOICE)
	 * need to hide!!!
	 * @param int $question_id
	 */
	private function isShowAnwers($question_id)
	{
		$qestion_type = Model::factory("Question")->getQuestionTypeById($question_id);
		if ($qestion_type == Question::QTYPE_INPUT_FIELD)
		{
			return false;
		}
		return true;
	}
	
	public function getAnswersByQuestion($question_id)
	{
		if ($this->isShowAnwers($question_id))
		{
			return $this->getEntityBy($this->fieldNames[1], $question_id);
		}
		else 
		{
			throw new HTTP_Exception_403("It's prohibited for this kind of questions");
		}			
	}
	
}
