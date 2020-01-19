<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package Model Classes
 * @name Model_Common class
 * @author Yuriy Bezgachnyuk, IF, Ukraine
 * @copyright (c) 2013-2016 by Yuriy Bezgachnyuk
 * @version 1.0
 * 
 * This class contain basic methods for works with entitity that represents table of database
 *
 */

abstract class Model_Common extends Model 
{

	/**
	 * This field contains database table name
	 *
	 * @var String - name of table of database
	 */
	protected $tableName = "";
	
	/**
	 * Array with names of fields of $this->tableName
	 *
	 * @var array
	 */
	protected $fieldNames = array();
	
	/**
	 *
	 * @var String - error message from database driver
	 */
	protected $errorMessage = "";

	/**
	 * get information about fieldnames of table
	 *
	 * @return array $this->fieldNames 
	 */
	public function getFieldNames() 
	{
		return $this->fieldNames;
	}
	
	/**
	 * Helper method for refactor methods in child classes 
	 * for example: getStudentsByGroup, getAnswersByQuestion, ...
	 * @param String $fieldName
	 * @param int $id
	 * @return MySQL ResultSet
	 * @access protected
	 * @author Yuriy V. Bezgachnyuk
	 */
	protected function getEntityBy($fieldName, $id, $sortField = 0)
	{
		$query = DB::select_array($this->fieldNames)
			->from($this->tableName)
			->where($fieldName, "=", $id)
			->order_by($this->fieldNames[$sortField], 'asc');
		$result = $query->as_object()->execute();
		return $result;
	}

	/**
	 * @access public
	 * @name countRecords
	 * @return int - number of records from $this->tableName table
	 */
	public function countRecords() 
	{
		$query = "SELECT COUNT({$this->fieldNames[0]}) AS count FROM {$this->tableName}";
		$count = DB::query(Database::SELECT, $query)->execute()->get('count');
		return intval($count);
	}
	
	/**
	 * Get the last record id of Entity
	 * @return int - number of last record id
	 */
	
	public function getLastRecordId()
	{
		$query = "SELECT MAX({$this->fieldNames[0]}) AS maxID FROM {$this->tableName}";
		$maxID = DB::query(Database::SELECT, $query)->execute()->get('maxID');
		return (is_null($maxID)) ? 0: intval($maxID);
	}

	/**
	 * Select records from database [for pagination]
	 *
	 * @access public
	 * @param int $limit - number or records
	 * @param int $offset - offset 
	 * @return mysql_object - records objects
	 */
	public function getRecordsRange($limit, $offset, $field = null, $direction = null) 
	{
		$query = null;
		if (!is_null($field) && (!is_null($direction)))
		{
			// with specific sorting
			if (!in_array($field, $this->fieldNames))
			{
				throw new HTTP_Exception_400("The filed name {$field} is not suitable for this entity");
			}
			
			$direction = intval($direction);			
			if (!in_array($direction, array(1, -1)))
			{
				throw new HTTP_Exception_400("The direction parameter have to be 1 or -1 only");
			}
			
			$direction = ($direction == 1) ? "asc" : "desc";

			$query = DB::select_array($this->fieldNames)
				->from($this->tableName)
				->order_by($field, $direction)
				->order_by($this->fieldNames[0], 'asc')
				->limit($limit)
				->offset($offset);
		}
		
		// without using specific sorting [common behavior]
		else 
		{
			$query = DB::select_array($this->fieldNames)
				->from($this->tableName)
				->order_by($this->fieldNames[0], 'asc')
				->limit($limit)
				->offset($offset);
		}
				
		$result = $query->as_object()->execute();
		return $result;
	}
	
	/**
	 * Get All records from $this->tableName table
	 *
	 * @return mysql_object - records objects
	 */
	public function getRecords() 
	{
		$query = DB::select_array($this->fieldNames)
			->from($this->tableName)
			->order_by($this->fieldNames[0], 'asc');
		$result = $query->as_object()->execute();
		return $result;
	}
	
	/**
	 * 
	 * @param array $ids - array with ID sequence
	 */
	public function getRecordsByIds($ids)
	{
		$query = DB::select_array($this->fieldNames)
			->from($this->tableName)
			->where($this->fieldNames[0], "IN", $ids)
			->order_by($this->fieldNames[0], 'asc');
		$result = $query->as_object()->execute();
		return $result;
	}

	/**
	 * Select one record from database
	 *
	 * @param int $record_id - primary key of $this->tableName table
	 * @return mysql_object - record object
	 */
	public function getRecord($record_id) 
	{
		$query = DB::select_array($this->fieldNames)
			->from($this->tableName)
			->where($this->fieldNames[0], "=", $record_id);
		$result = $query->as_object()->execute();
		return $result;
	}
	
	/**
	 * 
	 * @param string $fieldName
	 * @param string $criteria
	 * @return mysql_object - records object
	 */
	protected function getRecordsBySearchCriteria($fieldName, $criteria)
	{
		$query = DB::select_array($this->fieldNames)
			->from($this->tableName)
			->where($fieldName, "LIKE", "%".$criteria."%")
			->order_by($this->fieldNames[0], 'asc');
		$result = $query->as_object()->execute();
		return $result;
	}
	
	// new Register
	/**
	 * Store new record into table
	 *
	 * @param mixed array $values
	 * @return boolean - query result status
	 */
	public function registerRecord($values)
	{
		// check $values array
		if (count($values) !== (count($this->fieldNames) - 1)) {
			throw new HTTP_Exception_400("The number of fields of input object is not suitable for this entity");
		}
		
		$aff_rows = null;
		
		// change HTML special symbols to entities
		foreach ($values as $key => $value)
		{
			$values[$key] = htmlentities($value, ENT_QUOTES, "UTF-8");
		}
		
		// sync up with table field names sequence
		$_values = array();
		for ($i = 1;$i <= count($values);$i++)
		{
			if (!array_key_exists($this->fieldNames[$i], $values))
			{
				throw new HTTP_Exception_400("Wrong input data");
			}
			else 
			{
				$_values[$i - 1] = $values[$this->fieldNames[$i]];
			}
		}
		
		// Add zero for auto_increment primary key :-)
		array_unshift($_values, 0);
		
		$insertQuery = DB::insert($this->tableName, $this->fieldNames)->values($_values);
		try
		{
			list($insert_id, $aff_rows) = $insertQuery->execute();
		} catch (Database_Exception $error) {
			$this->errorMessage = "ERROR: ".$error->getMessage();
			throw new HTTP_Exception_400($this->errorMessage);
		}
		if ($aff_rows > 0) return intval($insert_id);
		if ($aff_rows <= 0) return false;
	}
		
	// new UPDATE
	/**
	 * Method for update information in $this->tableName table
	 *
	 * @param mixed array $values
	 * @return boolean - query result status
	 */
	public function updateRecord($values)
	{
		$aff_rows = null;
		
		// remove zero value for ID :-(
		$record_id = $values[0];
		array_shift($values);
		
		// change HTML special symbols to entities
		foreach ($values as $key => $value)
		{
			$values[$key] = htmlentities($value, ENT_QUOTES, "UTF-8");
		}
		
		// flip key and values for check request's parameters
		$ffn = array_flip($this->fieldNames);
		
		// check attributes of input object
		foreach ($values as $key => $value)
		{
			if (!array_key_exists($key, $ffn))
			{
				throw new HTTP_Exception_400("Wrong input data");
			}
		}
		
		$updateQuery = DB::update($this->tableName)->set($values)
			->where($this->fieldNames[0], '=', $record_id);
		try
		{
			$aff_rows = $updateQuery->execute();
		} catch (Database_Exception $error) {
			$this->errorMessage = "ERROR: ".$error->getMessage();
			throw new HTTP_Exception_400($this->errorMessage);
		}
		if ($aff_rows > 0) return true;
		if ($aff_rows == 0) return false;
	}
	
	/**
	 * Erase record from table with value of primary key equals to $record_id
	 *
	 * @param int $record_id
	 * @return boolean
	 */
	public function eraseRecord($record_id) 
	{
		$aff_rows = null;
		$eraseQuery = DB::delete($this->tableName)
			->where($this->fieldNames[0], "=", $record_id);
		try 
		{
			$aff_rows = $eraseQuery->execute();
		} catch (Database_Exception $error) {
			$this->errorMessage = "ERROR: ".$error->getMessage();
			throw new HTTP_Exception_400($this->errorMessage);
		}
		if ($aff_rows > 0) return true;
		if ($aff_rows == 0) return false;
	}
	
} // Common Model
