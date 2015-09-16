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
	
	public function checkAnswers($answer_ids)
	{
		if (!is_array($answer_ids))
		{
			throw new Kohana_Exception("Error input parameters");
		}
		else
		{
			$answers = $this->getRecordsByIds($answer_ids);
			foreach ($answers as $answer)
			{
				// check if incorrect
				if ($answer->true_answer == 0)
				{
					return false;
				}
				return true;
			}
		}
	}
	
}
