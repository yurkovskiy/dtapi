<?php defined('SYSPATH') or die('No direct script access.');

/**
 * EntityManager [Helper] Controller for handle AJAX requests
 *
 */

class Controller_EntityManager extends Controller_Base {
	
	// Strong security check for Student
	public function before()
	{
		if (Auth::instance()->logged_in($this->STUDENT_ROLE))
		{
			if (is_null(Session::instance()->get("startTime")))
			{
				throw new HTTP_Exception_403("You cannot call this method without making an quiz");
			}
		}
		parent::before();
	}

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
	
		// Read POST data in JSON format
		$params = @json_decode($this->request->body());
		
		// check if input data is given
		if (is_null($params) || (!is_object($params)))
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
			
			// check paramsArr keys
			if (!isset($paramsArr["entity"]) || !isset($paramsArr["ids"]))
			{
				throw new HTTP_Exception_400("Wrong input data");
			}
			
			
			// check id's
			if (!is_array($paramsArr["ids"]) || (count($paramsArr["ids"]) < 1))
			{
				throw new HTTP_Exception_400("EntityManager: Array required as a second parameter and cannot be empty");
			}
			
			else 
			{
				// student security check [Answers]
				if (Auth::instance()->logged_in($this->STUDENT_ROLE) && $paramsArr["entity"] != "Question")
				{
					throw new HTTP_Exception_403("It's prohibited to use this method for students");
				}
						
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
