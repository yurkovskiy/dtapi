<?php
class SimpleChoiceQuestion {
	
	public static function canShow()
	{
		return true;
	}
	
	public static function checkAnswers($question_id, $answer_ids)
	{
		$answers = Model::factory("Answer")->getRecordsByIds($answer_ids);
		foreach ($answers as $answer)
		{
			// check if incorect answer is present, so it's bad :-)
			return ($answer->true_answer == 0) ? false : true;			 
		}
	}
	
}
