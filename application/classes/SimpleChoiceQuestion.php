<?php
class SimpleChoiceQuestion {
	
	public static function checkAnswers($question_id, $answer_ids)
	{
		$true_answers_unumber = 0;
		$answers = Model::factory("Answer")->getRecordsByIds($answer_ids);
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
		
		return ($true_answers_unumber > 0) ? true : false;
	}
	
}
