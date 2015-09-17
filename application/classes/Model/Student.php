<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Students table model
 *
 */

class Model_Student extends Model_Common {
	
	protected $tableName = "students";
	protected $fieldNames = array("user_id", "gradebook_id","student_surname", "student_name", "student_fname","group_id", "plain_password", "photo");
	
	/*
	 * JSON Record for new student
	 * email, username, password, password_confirm
	 * gradebook_id, student_surname, student_name, student_fname, group_id
	 */
	
		
	public function registerRecord($values)
	{
		// first we need register user account uses User Model for future Auth
		$userModel = ORM::factory("User");
		
		// divide $values array
		$valuesForUserModel = array_slice($values, 0, 4);
		// workaround :-(
		$valuesForStudentModel = array_values(array_slice($values, 4, 7));
				
		try {
			$userModel->values($valuesForUserModel);
			$userModel->save();
		} catch (ORM_Validation_Exception $e) {
			return $e->getMessage();
		}	
		
		// Add roles for new user
		$userModel->add ( 'roles', ORM::factory ( 'role' )->where ( 'name', '=', 'login' )->find () );
		$userModel->add ( 'roles', ORM::factory ( 'role' )->where ( 'name', '=', 'student' )->find () );
		
		// Store information into students table
		
		$aff_rows = null;
		array_unshift($valuesForStudentModel, $userModel->id);
		// change HTML special symbols to entities
		for ($i = 0;$i < sizeof($valuesForStudentModel);$i++)
		{
			$valuesForStudentModel[$i] = htmlentities($valuesForStudentModel[$i], ENT_QUOTES, "UTF-8");
		}
		$insertQuery = DB::insert($this->tableName, $this->fieldNames)->values($valuesForStudentModel);
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
		if ($aff_rows <= 0) return false;
		
	}
	
	public function getStudentsByGroup($group_id)
	{
		return $this->getEntityBy($this->fieldNames[5], $group_id);
	}
	
}

