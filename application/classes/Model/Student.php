<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Students table model
 *
 */

class Model_Student extends Model_Common {
	
	protected $tableName = "students";
	protected $fieldNames = array("user_id", "gradebook_id","student_surname", "student_name", "student_fname","group_id", "plain_password", "photo");
	protected $fieldNames_ = array("user_id", "gradebook_id","student_surname", "student_name", "student_fname","group_id", "plain_password");
	
	public function getFieldNames_()
	{
		return $this->fieldNames_;
	}

	/**
	 * JSON Record for new student
	 * email, username, password, password_confirm
	 * gradebook_id, student_surname, student_name, student_fname, group_id
	 */
	public function registerRecord($values)
	{
		// first we need register user account uses User Model for future Auth
		$userModel = ORM::factory("User");
		
		$userModel_fields = array("username", "password", "password_confirm", "email");
		
		/* Fixed workaround with parameters 12.10.2017 */
		$valuesForUserModel = array();
		$valuesForStudentModel = array();
		
		foreach ($values as $k => $v) {
			if (in_array($k, $userModel_fields)) {
				$valuesForUserModel[$k] = $v;				
			}
			elseif (in_array($k, $this->fieldNames)) {
				$valuesForStudentModel[$k] = htmlentities($v, ENT_QUOTES, "UTF-8");				
			}
			else {
				throw new HTTP_Exception_400("Wrong insert parameters"); 
			}
		}
		/* End of Fix */
						
		try {
			$userModel->create_user($valuesForUserModel, array('username', 'password', 'email'));
		} catch (ORM_Validation_Exception $e) {
			throw new HTTP_Exception_400($e->getMessage());
		}	
		
		// Add roles for new user
		$userModel->add ('roles', ORM::factory ('role')->where ('name', '=', 'login')->find());
		$userModel->add ('roles', ORM::factory ('role')->where ('name', '=', 'student')->find());
		
		// Store information into students table
		
		$aff_rows = null;
		
		// Big Bug fix: 13.10.2017
		$valuesForStudentModel["user_id"] = $userModel->id;
		$insertQuery = DB::insert($this->tableName, array_keys($valuesForStudentModel))->values($valuesForStudentModel);
		// end of fix
		try
		{
			list($insert_id, $aff_rows) = $insertQuery->execute();
		} catch (Database_Exception $error) {
			$this->errorMessage = $error->getMessage();
			// also we need to delete record from users table :-(
			$userModel->delete();
			return $this->errorMessage;
		}
		if ($aff_rows > 0) return intval($userModel->id);
		if ($aff_rows == 0) return false;
		
	}
	
	public function updateRecord($values)
	{
		$model = null;
		$record_id = $values[0];
		// divide $values array
		array_shift($values);

		$userModel_fields = array("username", "password", "password_confirm", "email");
		
		/* Fixed workaround with parameters 12.10.2017 */
		$valuesForUserModel = array();
		$valuesForStudentModel = array();
		
		foreach ($values as $k => $v) {
			if (in_array($k, $userModel_fields)) {
				$valuesForUserModel[$k] = $v;
			}
			elseif (in_array($k, $this->fieldNames)) {
				$valuesForStudentModel[$k] = htmlentities($v, ENT_QUOTES, "UTF-8");;
			}
			else {
				throw new HTTP_Exception_400("Wrong insert parameters");
			}
		}
		/* End of Fix */
		
		try {
			$model = ORM::factory("User", $record_id)->update_user($valuesForUserModel);
		}
		catch (ORM_Validation_Exception $e) {
			throw new HTTP_Exception_400($e->getMessage());
		}
		
		// update data in studens table
		$aff_rows = null;
		
		$updateQuery = DB::update($this->tableName)
			->set($valuesForStudentModel)
			->where($this->fieldNames[0], '=', $record_id);
		try
		{
			$aff_rows = $updateQuery->execute();
		} catch (Database_Exception $error) {
			$this->errorMessage = "error ".$error->getCode();
			return $this->errorMessage;
		}
		if (($aff_rows > 0) || ($model->saved())) return true;
		if ($aff_rows == 0) return false;
	}
	
	public function getStudentsByGroup($group_id)
	{
		return $this->getEntityBy($this->fieldNames[5], $group_id, 2);
	}
	
	public function getRecordsBySearch($criteria)
	{
		return $this->getRecordsBySearchCriteria($this->fieldNames[2], $criteria);
	}

	public function isGradebookIdPresent($gradebook_id)
	{
		$query = "SELECT COUNT({$this->fieldNames[0]}) AS count FROM {$this->tableName} WHERE {$this->fieldNames[1]} = '{$gradebook_id}'";
		$count = DB::query(Database::SELECT, $query)->execute()->get('count');
		return intval($count);
	}
	
}
