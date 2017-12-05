<?php
class InputFieldQuestion {
	
	public static function canShow()
	{
		return false;
	}
	
	public static function checkAnswers($question_id, $answer_ids)
	{
		$tanswers = array(); // array with answer_text
		// we assume that for this question type we assign only true answers :-)
		$true_answers = Model::factory("Answer")->getAnswersByQuestion($question_id);
		foreach ($true_answers as $answer)
		{
			array_push($tanswers, $answer->answer_text);
		}
		
		// check if user's answer is present in $tanswers
		return (in_array($answer_ids[0], $tanswers)) ? true : false;
	}
}
