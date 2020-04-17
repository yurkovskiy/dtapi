<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Question table model
 *
 */

class Model_Question extends Model_Common {
	
	protected $tableName = "questions";
	protected $fieldNames = array("question_id", "test_id", "question_text", "level", "type", "attachment");
	protected $_fieldNames = array("question_id", "test_id", "question_text", "level", "type");
	
	public function getFieldNames_()
	{
		return $this->_fieldNames;
	}
			
	/**
	 *
	 * @param int $test_id
	 * @param int $level
	 * @param int $number
	 * @return MySQL Result Set
	 */
	public function getQuestionIdsByLevelRand($test_id, $level, $number)
	{
		$query = DB::query(Database::SELECT, 
				"SELECT {$this->fieldNames[0]} FROM {$this->tableName} 
		WHERE {$this->fieldNames[1]} = {$test_id} AND {$this->fieldNames[3]} = {$level} ORDER BY RAND() LIMIT {$number}");		
		$result = $query->as_object()->execute();
		return $result;
	}
	
	/**
	 * 
	 * @param int $test_id
	 * @return int $count - number of records
	 */
	public function countQuestionsByTest($test_id)
	{
		$query = "SELECT COUNT({$this->fieldNames[0]}) AS count FROM {$this->tableName} WHERE {$this->fieldNames[1]} = {$test_id}";
		$count = DB::query(Database::SELECT, $query)->execute()->get("count");
		return intval($count);
	}
	
	/**
	 * 
	 * @param int $question_id
	 * @return int $test_id - test_id which is using together with TestDetail when calculating the mark
	 */
	public function getTestIdByQuestion($question_id)
	{
		$query = "SELECT {$this->fieldNames[1]} AS id FROM {$this->tableName} WHERE {$this->fieldNames[0]} = {$question_id}";
		$test_id = DB::query(Database::SELECT, $query)->execute()->get("id");
		return intval($test_id);
	}
	
	/**
	 *
	 * @param int $question_id
	 * @return int $level - level_id which is using together with TestDetail when calculating the mark
	 */
	public function getLevelIdByQuestion($question_id)
	{
		$query = "SELECT {$this->fieldNames[3]} AS id FROM {$this->tableName} WHERE {$this->fieldNames[0]} = {$question_id}";
		$level_id = DB::query(Database::SELECT, $query)->execute()->get("id");
		return intval($level_id);
	}
	
	/**
	 * 
	 * @param int $test_id
	 * @param int $limit
	 * @param int $offset
	 * @param boolean $without_images
	 * @return MySQL Result Set
	 */
	public function getQuestionsRangeByTest($test_id, $limit, $offset, $without_images = false)
	{
		if ($without_images) $this->fieldNames = $this->_fieldNames;
		 
		$query = DB::select_array($this->fieldNames)
				->from($this->tableName)
				->where($this->fieldNames[1], "=", $test_id)
				->order_by($this->fieldNames[0], 'asc')
				->limit($limit)
				->offset($offset);
		$result = $query->as_object()->execute();
		return $result;
	}
	
	/**
	 * 
	 * @param int $question_id
	 * @return int question type
	 * 1 - SIMPLECHOICE
	 * 2 - MULTICHOICE
	 * 3 - INPUTFIELD
	 * 4 - NUMERICAL
	 */
	public function getQuestionTypeById($question_id)
	{
		$query = DB::select($this->fieldNames[4])
				->from($this->tableName)
				->where($this->fieldNames[0], "=", $question_id);
		$result = $query->as_object()->execute();
		foreach ($result as $question)
		{
			return intval($question->type);
		}
	}
	
}
