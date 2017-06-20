<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Answer [Student] Controller for handle AJAX requests
 *
 */

class Controller_SAnswer extends Controller_BaseAjax {

	protected $modelName = "SAnswer";
	
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
	 * @param JSON object with following structure
	 * [{question_id: 10, answer_ids: [1,2,3,4]}, {question_id: 18, answer_ids:[10]}, ...]
	 * @return JSON object with following structure
	 * [{question_id: 10, true: 0}, {question_id: 18, true: 1}, ...]
	 */
	public function action_checkAnswers()
	{
		$model = null;
		$result = array();
		
		$session = Session::instance();
		
		// Security check
		if (!is_null($session->get("CheckAns")))
		{
			throw new HTTP_Exception_400("It is prohibited to use this method twice during one session");
		}
		
		// Read POST data in JSON format
		$params = @json_decode(file_get_contents($this->RAW_DATA_SOURCE));
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
			
			// Security check: save data to the Session
			$session->set("CheckAns", "used");
			
			/* FULL MARK CALCULATION SECTION */
			// Walking over the $result[] array
			$test_id = null;
			$fullMark = 0;
			$numberOfTrueAnswers = 0;
			foreach ($result as $item)
			{
				$level = Model::factory("Question")->getLevelIdByQuestion($item["question_id"]);
				if (is_null($test_id))
				{
					$test_id = Model::factory("Question")->getTestIdByQuestion($item["question_id"]);
				}
				// get mark for the question
				$rates = Model::factory("TestDetail")->getRateByTestAndLevel($test_id, $level);
				foreach ($rates as $rate) 
				{
					if ($item["true"] == 1)
					{
						$fullMark += intval($rate->rate);
						$numberOfTrueAnswers++;
					}
				}
			}
			/* END OF FULL MARK CALCULATION SECTION */
			
			// generate JSON object with result
			$fullResult = array("full_mark" => $fullMark, 
								"number_of_true_answers" => $numberOfTrueAnswers);
			$this->response->body(json_encode($fullResult, JSON_UNESCAPED_UNICODE));
		}
	}

}
