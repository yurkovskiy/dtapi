<?php
class MultiChoiceQuestion {
	
	public static function canShow()
	{
		return true;
	}
	
	public static function checkAnswers($question_id, $answer_ids)
	{
		$true_answers_unumber = 0;
		$answers = Model::factory("Answer")->getRecordsByIds($answer_ids);
		$true_answers_number = Model::factory("Answer")->countTrueAnswersByQuestion($question_id);
		
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
		
		return ($true_answers_unumber == $true_answers_number) ? true : false;
	}
	
}
