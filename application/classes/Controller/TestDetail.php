<?php defined('SYSPATH') or die('No direct script access.');

/**
 * TestDetail Controller for handle AJAX requests
 *
 */

class Controller_TestDetail extends Controller_BaseAdmin {

	public function action_getTestDetailsByTest()
	{
		return $this->getEntityRecordsBy("getTestDetailsByTest");
	}
	
	/**
	 * @name getTestRate - return rate for test by using test parameters
	 */
	public function action_getTestRate()
	{
		$test_id = $this->request->param("id");
		if ((!is_numeric($test_id)) || ($test_id <= 0))
		{
			throw new HTTP_Exception_400("Wrong input parameters");
		}
		else
		{
			$rate = 0; // accumulator
			$test_details = Model::factory($this->modelName)->getTestDetailsByTest($test_id);
			foreach ($test_details as $test_detail)
			{
				$rate += intval($test_detail->tasks) * intval($test_detail->rate);
			}
			if ($rate === 0)
			{
				throw new HTTP_Exception_400("Probably test with id: {$test_id} does not present or does not have any parameter records");
			}
			$this->response->body(json_encode(array("testRate" => $rate), JSON_UNESCAPED_UNICODE));
		}
	}
	
}
