<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Answer [Student] Controller for handle AJAX requests
 *
 */

class Controller_SAnswer extends Controller_BaseAjax {

	public function action_insertData()
	{
		throw new HTTP_Exception_404("Not found for this entity");
	}
	
	public function action_update()
	{
		throw new HTTP_Exception_404("Not found for this entity");
	}
	
	public function action_del()
	{
		throw new HTTP_Exception_404("Not found for this entity");
	}
	
	public function action_getAnswersByQuestion()
	{
		// Security check
		if (is_null(Session::instance()->get("startTime"))) // User can't see answers without making an quiz
		{
			throw new HTTP_Exception_403("You cannot call this method without making an quiz");
		}
		return $this->getEntityRecordsBy("getAnswersByQuestion");
	}
	
	/**
	 * Should be mocked, because a lot of records in DB present
	 * Please use getRecordsRange only
	 * @see Controller_BaseAjax::action_getRecords()
	 */
	public function action_getRecords()
	{
		throw new HTTP_Exception_404("Not found for this entity");
	}
	
	/**
	 * Should be mocked, because a lot of records in DB present
	 * Please use getRecordsRange only
	 * @see Controller_BaseAjax::action_getRecordsRange()
	 */
	public function action_getRecordsRange()
	{
		throw new HTTP_Exception_404("Not found for this entity");
	}
	
	
	/**
	 * @param JSON object with following structure
	 * [{question_id: 10, answer_ids: [1,2,3,4]}, {question_id: 18, answer_ids:[10]}, ...]
	 * @return JSON object with following structure
	 * [{question_id: 10, true: 0}, {question_id: 18, true: 1}, ...] // middle object
	 * @return JSON object with following structure
	 * {"full_mark": <int>, "number_of_true_answers": <int>}
	 */
	public function action_checkAnswers()
	{
		$model = null;
		$result = array();
		
		$session = Session::instance();
		
		/* Security check */
		// 1 step
		if (is_null($session->get("startTime"))) // if user would like to cheat :-(
		{
			$session->destroy();
			throw new HTTP_Exception_400("Would you like to be a superman? You have been logout");
		}
		
		/* End of Security check */
		
		// Read POST data in JSON format
		$data = $this->request->body();
		$params = @json_decode($data);
		// check if input data is given
		if (is_null($params) || (!is_array($params)))
		{
			throw new HTTP_Exception_400("Wrong input data");
		}
		else
		{
			foreach ($params as $question)
			{
				$model = Model::factory("Answer")->checkAnswers($question->question_id, $question->answer_ids);
				if ($model)
				{
					$result[] = array("question_id" => $question->question_id, "true" => 1);
				}
				else 
				{
					$result[] = array("question_id" => $question->question_id, "true" => 0);
				}
			}
			
			/* FULL MARK CALCULATION SECTION */
			// Walking over the $result[] array
			$test_id = null;
			$fullMark = 0;
			$numberOfTrueAnswers = 0;
			$testDetails = array();
			$questions = array(); // list of questions which were provided to user
			
			foreach ($result as $item)
			{
				$level = Model::factory("Question")->getLevelIdByQuestion($item["question_id"]);
				if (is_null($test_id))
				{
					$test_id = Model::factory("Question")->getTestIdByQuestion($item["question_id"]);
					
					// Get information from test details
					$testParameters = Model::factory("TestDetail")->getTestDetailsByTest($test_id);
					foreach ($testParameters as $testParam)
					{
						$testDetails[$testParam->level] = $testParam->rate;
					}
				}
				// check and add* mark for the question
				if (($item["true"] == 1) && (!in_array($item["question_id"], $questions)))
				{
					$fullMark += intval($testDetails[$level]);
					$numberOfTrueAnswers++;
					array_push($questions, $item["question_id"]); // save question_id into the array
				}
			}
			/* END OF FULL MARK CALCULATION SECTION */
			
			// generate JSON object with result
			$fullResult = array(
					"full_mark" => $fullMark, 
					"number_of_true_answers" => $numberOfTrueAnswers);
			
			/* Save data into the results table */
			// generate data object
			$resultArr = array(
					"student_id" => Auth::instance()->get_user()->id,
					"test_id" => $test_id,
					"session_date" => date("Y-m-d"),
					"start_time" => $session->get("startTime"),
					"end_time" => date("H:i:s"),
					"result" => $fullMark,
					"questions" => $data,
					"true_answers" => json_encode($result, JSON_UNESCAPED_UNICODE),
					"answers" => Model::factory("TestDetail")->getTestRate($test_id)
			);
			
			$model = Model::factory("Result")->registerRecord($resultArr);
			if ($model)
			{
				$session->delete("startTime"); // delete startTime from session
			}
			
			$this->response->body(json_encode($fullResult, JSON_UNESCAPED_UNICODE));
		}
	}

}
