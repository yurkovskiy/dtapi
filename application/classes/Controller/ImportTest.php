<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @name d-tester XML dt1-->dt2 dt-XMLv2 import Controller
 * @author Yuriy Bezgachnyuk
 * Special Controller for importing questions from d-tester 1.0
 * to dtapi 2.1
 *
 */

class Controller_ImportTest extends Controller_BaseAdmin {
	
	private $quetion_types_substitution = array(
			0 => Question::SimpleChoice,
			1 => Question::SimpleChoice,
			2 => Question::MultiChoice,
			3 => Question::MultiChoice,
			4 => Question::InputField,
			5 => Question::InputField,
			6 => Question::Numerical,
			7 => Question::Numerical			
	);
	
	public function action_import()
	{
		$test_id = $this->request->param("id");
		if (!is_numeric($test_id)) {
			throw new HTTP_Exception_400("Wrong Input parameters");
		}
		
		// check if the test with $test_id is present in the system
		$test = Model::factory("Test")->getRecord($test_id);
		if (!$test) {
			throw new HTTP_Exception_404("The test with id: {$test_id} not found in the system");
		}
		unset($test);
		
		// xml file
		$xml_file = $this->request->param("id1");
		$xml_file = "/home/yurkovskiy/dtapi/test_".$xml_file.".xml";
		$xml = @simplexml_load_file($xml_file);
		if (!$xml) {
			throw new HTTP_Exception_400("XML Parse Error");
		}
		
		$count = 0;
		
		// working with XML file
		// extract questions
		foreach ($xml->question as $question) {
			$question_el = array(
					"test_id" => $test_id, 
					"question_text" => strval($question->question_text), 
					"level" => intval($question->level),
					"type" => $this->quetion_types_substitution[intval($question->type)],
					"attachment" => (count(strval($question->attachment)) == 0) ? "" : strval($question->attachment)
			);
			/* print_r($question_el);
			exit(1); */
			$question_id = Model::factory("Question")->registerRecord($question_el);
			if (!is_numeric($question_id)) {
				throw new HTTP_Exception_400("Some error when registering the record: {$question_el}");
			}
			
			// extract answers for current question
			foreach ($question->answers->answer as $answer) {
				$answer_el = array(
						"question_id" => $question_id,
						"true_answer" => intval($answer->true_answer) - 1,
						"answer_text" => strval($answer->answer_text),
						"attachment" => (count(strval($answer->attachment)) == 0) ? "" : strval($answer->attachment)
				);
				$answer_id = Model::factory("Answer")->registerRecord($answer_el);
				if (!is_numeric($answer_id)) {
					throw new HTTP_Exception_400("Some error when registering the record: {$answer_el}");
				}
			} // foreach answers
			$count++;
		} // foreach questions
		$this->response->body(json_encode(array("numberOfImportedQuestions" => $count)));
	} // end of method
	
}
