<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Question Controller for handle AJAX requests
 *
 */

class Controller_Question extends Controller_BaseAdmin {

	protected $modelName = "Question";
	
	public function action_getQuestionsByLevelRand()
	{
		// get parameters from GET request		
		$test_id = $this->request->param("id");
		$level = $this->request->param("id1");
		$number = $this->request->param("id2");
		
		$result = array();
		$DBResult = null;
		
		$DBResult = Model::factory($this->modelName)->getQuestionsByLevelRand($test_id, $level, $number);
		$fieldNames = Model::factory($this->modelName)->getFieldNames();
		foreach ($DBResult as $data)
		{
			$item = array();
			foreach ($fieldNames as $fieldName) {
				$item[$fieldName] = $data->$fieldName;
			}
			array_push($result, $item);
		}
		if (sizeof($result) < 1)
		{
			$result[] = array('record_id', 'null');
		}
		$r = json_encode($result);
		$this->response->body($r);
	}

}