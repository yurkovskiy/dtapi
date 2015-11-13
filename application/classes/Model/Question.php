<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class with definitions Question table model
 *
 */

class Model_Question extends Model_Common {
	
	protected $tableName = "questions";
	protected $fieldNames = array("question_id", "test_id", "question_text", "level", "type", "attachment");
	
	/**
	 * 
	 * @param int $test_id
	 * @param int $level
	 * @param int $number
	 * @return MySQL Result Set
	 */
	public function getQuestionsByLevelRand($test_id, $level, $number)
	{
		$query = DB::select_array($this->fieldNames)->from($this->tableName)
				->where($this->fieldNames[1], "=", $test_id)
				->and_where($this->fieldNames[3], "=", $level)
				->order_by("", 'RAND()')
				->limit($number);
		$result = $query->as_object()->execute();
		return $result;
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
		$query = DB::select($this->fieldNames[0])->from($this->tableName)
		->where($this->fieldNames[1], "=", $test_id)
		->and_where($this->fieldNames[3], "=", $level)
		->order_by("", 'RAND()')
		->limit($number);
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
		$query = "SELECT COUNT(*) AS count FROM {$this->tableName} WHERE {$this->fieldNames[1]} = {$test_id}";
		$count = DB::query(Database::SELECT, $query)->execute()->get('count');
		return $count;
	}
	
	/**
	 * 
	 * @param int $test_id
	 * @param int $limit
	 * @param int $offset
	 * @return MySQL Result Set
	 */
	public function getQuestionsRangeByTest($test_id, $limit, $offset)
	{
		$query = DB::select_array($this->fieldNames)
				->from($this->tableName)
				->where($this->fieldNames[1], "=", $test_id)
				->order_by($this->fieldNames[0], 'asc')
				->limit($limit)
				->offset($offset);
		$result = $query->as_object()->execute();
		return $result;
	}
	
	public function getQuestionTypeById($question_id)
	{
		$query = DB::select($this->fieldNames[4])
				->from($this->tableName)
				->where($this->fieldNames[0], "=", $question_id);
		$result = $query->as_object()->execute();
		foreach ($result as $question)
		{
			return $question->type;
		}
	}
	
}
