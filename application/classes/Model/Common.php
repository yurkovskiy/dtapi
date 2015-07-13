<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @package Models Classes
 * @name Model_Common class
 * @author Yuriy Bezgachnyuk, IF, Ukraine
 * @copyright 2013 by Yuriy Bezgachnyuk
 * @version 0.1
 * 
 * This class contains basic methods for works with entitity that represents of table of database
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
	 * @access public
	 * @name countRecords
	 * @return int - number of records from $this->tableName table
	 */
	public function countRecords() 
	{
		$query = "SELECT COUNT(*) AS count FROM {$this->tableName}";
		$count = DB::query(Database::SELECT, $query)->execute()->get('count');
		return $count;
	}

	/**
	 * Select records from database [for pagination]
	 *
	 * @access public
	 * @param int $limit - number or records
	 * @param int $offset - offset 
	 * @return mysql_object - records objects
	 */
	public function getRecordsRange($limit, $offset) 
	{
		$query = DB::select_array($this->fieldNames)->from($this->tableName)->order_by($this->fieldNames[0], 'asc')->limit($limit)->offset($offset);
		$result = $query->as_object()->execute();
		return $result;
	}
	
	/**
	 * Get number of records which matches by $letters template
	 *
	 * @param unknown_type $letters
	 * @return unknown
	 */
	public function countRecordsByLetters($letters)
	{
		$letters = "%".$letters."%";
		$query = "SELECT COUNT(*) AS count FROM {$this->tableName} WHERE {$this->fieldNames[1]} LIKE '{$letters}'";
		$count = DB::query(Database::SELECT, $query)->execute()->get('count');
		return $count;
		
	}
	
	/**
	 * Get Records range by letters
	 *
	 * @param int $limit
	 * @param int $offset
	 * @param string $letters
	 * @return MySQL Object
	 */
	public function getRecordsRangeByLetters($limit, $offset, $letters) 
	{
		$letters = "%".$letters."%";
		$query = DB::select_array($this->fieldNames)->from($this->tableName)->where($this->fieldNames[1], "LIKE", $letters)->order_by($this->fieldNames[0], 'asc')->limit($limit)->offset($offset);
		$result = $query->as_object()->execute();
		return $result;
	}
	
	public function getRecordsByLetters($letters) 
	{
		$letters = "%".$letters."%";
		$query = DB::select_array($this->fieldNames)->from($this->tableName)->where($this->fieldNames[1], "LIKE", $letters)->order_by($this->fieldNames[0], 'asc');
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
		$query = DB::select_array($this->fieldNames)->from($this->tableName)->order_by($this->fieldNames[0], 'asc');
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
		$query = DB::select_array($this->fieldNames)->from($this->tableName)->where($this->fieldNames[0], "=", $record_id);
		$result = $query->as_object()->execute();
		return $result;
	}

	/**
	 * Store new record into table
	 *
	 * @param mixed array $values
	 * @return boolean - query result status
	 */
	public function registerRecord($values) 
	{
		$aff_rows = null;
		
		// change HTML special symbols to entities
		for ($i = 0;$i < sizeof($values);$i++)
		{
			$values[$i] = htmlentities($values[$i], ENT_QUOTES, "UTF-8");
		}
		$insertQuery = DB::insert($this->tableName, $this->fieldNames)->values($values);
		try 
		{
			list($insert_id, $aff_rows) = $insertQuery->execute();
		} catch (Database_Exception $error) {
			$this->errorMessage = "Code: ".$error->getCode()."\n".$error->getMessage();
			return false;
		}
		if ($aff_rows > 0) return true;
		if ($aff_rows <= 0) return false;
	}

	/**
	 * Method for update information in $this->tableName table
	 *
	 * @param mixed array $values
	 * @return boolean - query result status
	 */
	public function updateRecord($values) 
	{
		/**
		 * @var array $pairs - array with data $pairs[field name] = value
		 */
		$pairs = array();
		$rows = null;
		
		// change HTML special symbols to entities
		for ($i = 0;$i < sizeof($values);$i++)
		{
			$values[$i] = htmlentities($values[$i], ENT_QUOTES, "UTF-8");
		}

		for ($i = 1;$i < sizeof($this->fieldNames);$i++) 
		{
			$pairs[$this->fieldNames[$i]] = $values[$i];
		}

		$updateQuery = DB::update($this->tableName)
		->set($pairs)->where($this->fieldNames[0], '=', $values[0]);
		try 
		{
			$rows = $updateQuery->execute();
		} catch (Database_Exception $error) {
			$this->errorMessage = "Code: ".$error->getCode()."\n".$error->getMessage();
			return false;
		}
		if ($rows > 0) return true;
		if ($rows == 0) return true;
	}

	/**
	 * Erase record from table with value of primary key equals to $record_id
	 *
	 * @param int $record_id
	 * @return boolean
	 */
	public function eraseRecord($record_id) 
	{
		$rows = null;
		$eraseQuery = DB::delete($this->tableName)->where($this->fieldNames[0], "=", $record_id);
		try 
		{
			$rows = $eraseQuery->execute();
		} catch (Database_Exception $error) {
			$this->errorMessage = "Code: ".$error->getCode()."\n".$error->getMessage();
			return false;
		}
		if ($rows > 0) return true;
		if ($rows == 0) return true;
	}

} // Common Model