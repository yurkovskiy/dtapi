<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Student Controller for handle AJAX requests
 *
 */

class Controller_Student extends Controller_BaseAdmin {

	// security check for student
	public function before()
	{
		if (Auth::instance()->logged_in($this->STUDENT_ROLE))
		{
			if ($this->request->action() != "getRecords")
			{
				throw new HTTP_Exception_403("You don't have permissions to run this method"); 
			}			
		}
		parent::before();
	}
	
	public function action_getRecords()
	{
		// Security checking: Student can see only record about himself
		if (Auth::instance()->logged_in($this->STUDENT_ROLE))
		{
			if ($this->request->param("id") != Auth::instance()->get_user()->id)
			{
				throw new HTTP_Exception_403("You don't have permissions to use this method in that way");
			}
		}
		
		// only one record due to a lot of data
		$record_id = $this->request->param("id");
		if (isset($record_id))
		{
			parent::action_getRecords();
		}
		else 
		{
			throw new HTTP_Exception_400("This method allowed for gathering one record only");
		}
		
	}
	
	public function action_insertData()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to insert records");
		}
		else 
		{
			$result = array();
			// Read POST data in JSON format
			$params = json_decode($this->request->body());
			
			if (!$this->checkInputParams($params))
			{
				throw new HTTP_Exception_400("Wrong request");
			}
			
			// Convert Object into Array
			$paramsArr = get_object_vars($params);
									
			//$values = array_values($paramsArr);
			$values = $paramsArr;
			
			$model = Model::factory($this->modelName)->registerRecord($values);
			if (!is_string($model) && is_int($model))
			{
				// Creating response in JSON format
				$result["id"] = $model;
				$result["response"] = "ok";
			}
			else
			{
				if (is_string($model))
				{
					$result["response"] = $model;
				}
				else
				{
					$result["response"] = "error";
				}
					
			}
			$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
		}
	}
	
	public function action_update()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to insert records");
		}
		else 
		{
			$record_id = $this->request->param("id");
			$result = array();
			
			// check input parameters
			if ((!isset($record_id)) || (!is_numeric($record_id)) || ($record_id <= 0))
			{
				throw new HTTP_Exception_400("Wrong request");
			}
			else
			{
				// Read POST data in JSON format
				$params = json_decode($this->request->body());
				
				if (!$this->checkInputParams($params))
				{
					throw new HTTP_Exception_400("Wrong request");
				}
				
				// Convert Object into Array
				$paramsArr = get_object_vars($params);
					
				//$values = array_values($paramsArr);
				$values = $paramsArr;
				array_unshift($values, $record_id); // Add record_id value for Primary Key
				
				$model = Model::factory($this->modelName)->updateRecord($values);
				if (!is_string($model) && $model)
				{
					// Creating response in JSON format
					$result["response"] = "ok";
				}
				else
				{
					if (is_string($model))
					{
						$result["response"] = $model;
					}
					else
					{
						throw new HTTP_Exception_400("Error when update");
					}
						
				}
			}
			$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
		}
	}
	
	public function action_del() 
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403("You don't have permissions to delete records");
		}
		else
		{
			$record_id = $this->request->param("id");
			// check input parameters
			if ((!isset($record_id)) || (!is_numeric($record_id)) || ($record_id <= 0))
			{
				throw new HTTP_Exception_400("Wrong request");
			}
			else 
			{
				// try to delete information from student table
				$model = Model::factory($this->modelName)->eraseRecord($record_id);
				if (!is_string($model) && $model)
				{
					// Everything is OK! then we can delete information from users table
					try {
						$model = ORM::factory("User", $record_id);
						$model->delete();
						$this->response->body(json_encode(array("response" => "ok")));
					} catch (Kohana_Exception $e) {
						throw new HTTP_Exception_400($e->getMessage());
					}
				}
				else
				{
					// Some problem
					throw new HTTP_Exception_400("Error when delete");
				}
			}
		}
	} // end of action_del
	
	public function action_getStudentsByGroup()
	{
		$without_images = $this->request->param("id1");
		if (!is_null($without_images))
		{
			return $this->getEntityRecordsBy("getStudentsByGroup", Model::factory($this->modelName)->getFieldNames_());
		}		
		return $this->getEntityRecordsBy("getStudentsByGroup");
	}
	
	public function action_getRecordsBySearch()
	{
		return $this->getRecordsBySearchCriteria();
	}

	public function action_checkGradebookId()
	{
		$gradebook_id = $this->request->param("id");
		$model = Model::factory($this->modelName)->isGradebookIdPresent($gradebook_id);
		$response = ($model === 1) ? true : false;
		$this->response->body(json_encode(array("response" => $response), JSON_UNESCAPED_UNICODE));
	}

}
