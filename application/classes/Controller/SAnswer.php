<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Answer [Student] Controller for handle AJAX requests
 *
 */

class Controller_SAnswer extends Controller_BaseAjax {

	protected $modelName = "SAnswer";
	
	public function action_insertData()
	{
		throw new HTTP_Exception_404("Not found for users");
	}
	
	public function action_update()
	{
		throw new HTTP_Exception_404("Not found for users");
	}
	
	public function action_del()
	{
		throw new HTTP_Exception_404("Not found for users");
	}
	
	public function action_getAnswersByQuestion()
	{
		return $this->getEntityRecordsBy("getAnswersByQuestion");
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
		
		// Read POST data in JSON format
		$params = @json_decode(file_get_contents($this->RAW_DATA_SOURCE));
		// check if input data is given
		if (is_null($params))
		{
			throw new HTTP_Exception_400("No input data");
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
			$this->response->body(json_encode($result));
		}
	}

}
