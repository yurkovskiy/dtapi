<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Answer table model
 *
 */

class Model_Answer extends Model_Common implements Question {
	
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
		$true_answers_unumber = 0; // user's number
		$true_answers_number = 0; // by default;
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
			
			// input field
			if ($question_type == Question::QTYPE_INPUT_FIELD)
			{
				$tanswers = array(); // array with answer_text
				// we assume that for this question type we assign only true answers :-)
				$true_answers = $this->getAnswersByQuestion($question_id);
				foreach ($true_answers as $answer)
				{
					array_push($tanswers, $answer->answer_text);
				}
				// check if user's answer is present in $tanswers
				if (in_array($answer_ids[0], $tanswers))
				{
					unset($tanswers);
					return true;
				}
				// anyway return false :-)
				return false;
			} // input field
			
			// multi choice
			if ($question_type == Question::QTYPE_MULTI_CHOICE)
			{
				$true_answers_number = $this->countTrueAnswersByQuestion($question_id);
			}
			
			// get answers [Simple/Multi Choice]
			$answers = $this->getRecordsByIds($answer_ids);
			
			foreach ($answers as $answer)
			{
				// check if incorect answer is present, so it's bad :-)
				if ($answer->true_answer == 0)
				{
					return false;
				}
				else 
				{
					$true_answers_unumber++;
				}
			}
			
			// final check
			// simple choice
			if (($question_type == Question::QTYPE_SIMPLE_CHOICE) && ($true_answers_unumber > 0))
			{
				return true;
			}
			// multi choice, strong check
			if (($question_type == Question::QTYPE_MULTI_CHOICE) && ($true_answers_unumber == $true_answers_number))
			{
				return true;
			}
			
			return false;
		} // else (no exception)
	}
	
}
