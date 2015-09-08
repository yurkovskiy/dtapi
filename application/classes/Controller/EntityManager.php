<?php defined('SYSPATH') or die('No direct script access.');

/**
 * EntityManager [Helper] Controller for handle AJAX requests
 *
 */

class Controller_EntityManager extends Controller_Base {

	public function action_getEntityValues()
	{
		
		// output result
		$result = array();
		
		// Read POST data in JSON format
		$params = @json_decode(file_get_contents($this->RAW_DATA_SOURCE));
		
		// check if input data is given
		if (is_null($params))
		{
			$this->response->body(json_encode(array("response" => "No input data")));
		}
		else 
		{
			/*
			 * Convert Object into Array
			 * [entity] - name of Entity
			 * [ids] - values with IDs
			*/
			$paramsArr = get_object_vars($params);
			if (count($paramsArr) == 0)
			{
				$this->response->body(json_encode(array("response" => "No input data")));
			}
			else 
			{
				$DBResult = Model::factory($paramsArr["entity"])
					->getRecordsByIds($paramsArr["ids"]);
				$fieldNames = Model::factory($paramsArr["entity"])->getFieldNames();
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
				$this->response->body(json_encode($result));
			}
		}
	}

}
