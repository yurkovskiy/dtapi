<?php
class NumericalQuestion {
	
	public static function canShow()
	{
		return false;
	}
	
	public static function checkAnswers($question_id, $answer_ids)
	{
		$tanswers = array(); // array with answer_text
		// we assume that for this question type we assign only true answers :-)
		// and only two answers
		$true_answers = Model::factory("Answer")->getAnswersByQuestion($question_id);
		foreach ($true_answers as $answer)
		{
			array_push($tanswers, $answer->answer_text);
		}
		// check if user's answer is present in $tanswers
		if (($answer_ids[0] >= doubleval($tanswers[0])) && ($answer_ids[0] <= doubleval($tanswers[1])))
		{
			return true;
		}
		// anyway return false :-)
		return false;
		
	}
	
}
