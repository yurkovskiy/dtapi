<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Answer table model
 *
 */

class Model_Answer extends Model_Common {
	
	protected $tableName = "answers";
	protected $fieldNames = array("answer_id","question_id", "true_answer", "answer_text", "attachment");
	protected $fieldNames_ = array("answer_id","question_id", "true_answer", "answer_text");
	
	public function getFieldNames_()
	{
		return $this->fieldNames_;
	}
	
	public function getAnswersByQuestion($question_id)
	{
		return $this->getEntityBy($this->fieldNames[1], $question_id);
	}
	
	public function countTrueAnswersByQuestion($question_id)
	{
		$query = "SELECT COUNT({$this->fieldNames[0]}) AS count 
				FROM {$this->tableName} 
				WHERE {$this->fieldNames[2]} = 1
				AND {$this->fieldNames[1]} = {$question_id}";
		$count = DB::query(Database::SELECT, $query)->execute()->get('count');
		return $count;
	}
	
	public function checkAnswers($question_id, $answer_ids)
	{
		if (!is_array($answer_ids))
		{
			throw new HTTP_Exception_400("Wrong input parameters");
		}
		
		// no answers from user
		if (count($answer_ids) == 0)
		{
			return false;
		}
		else
		{
			// get question type
			$question_type = Model::factory("Question")->getQuestionTypeById($question_id);
			// find out constant name of question type for reflect class
			$question_type = array_flip((new ReflectionClass("Question"))->getConstants())[$question_type];
			$class_name = $question_type."Question";
			
			return $class_name::checkAnswers($question_id, $answer_ids);
			
		} // else (no exception)
	} // end of method
	
}
