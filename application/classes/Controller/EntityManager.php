<?php defined('SYSPATH') or die('No direct script access.');

/**
 * EntityManager [Helper] Controller for handle AJAX requests
 *
 */

class Controller_EntityManager extends Controller_Base {

	/**
	 * @name getEntityValues
	 * @param JSON Object {entity:"", ids:[]}
	 * @return JSON Object with entitites
	 * 
	 * With using this method we can get information about entities 
	 * which ID's were transfered throught ids array of JSON
	 * Example: http://host_name/EntityManager/getEntityValues with POST JSON Object
	 * {"entity":"subject", "ids":[1,2,3,4,5]} 
	 */
	public function action_getEntityValues()
	{
		
		// output result
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
			/*
			 * Convert Object into Array
			 * [entity] - name of Entity
			 * [ids] - values with IDs
			*/
			$paramsArr = get_object_vars($params);
			if (count($paramsArr) == 0)
			{
				throw new HTTP_Exception_400("No input data");
			}
			else 
			{
				// check if Entity Model is present
				if (strlen(Kohana::find_file("classes", "Model/".$paramsArr["entity"])) < 1) 
				{
					throw new HTTP_Exception_400("Could not find entity model");
				}
				$DBResult = Model::factory($paramsArr["entity"])
					->getRecordsByIds($paramsArr["ids"]);
				$fieldNames = Model::factory($paramsArr["entity"])->getFieldNames();
								
				$this->buildJSONResponse($DBResult, $fieldNames);
			}
		}
	}

}
