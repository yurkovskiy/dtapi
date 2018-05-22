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
			$rate = Model::factory($this->modelName)->getTestRate($test_id);
			$this->response->body(json_encode(array("testRate" => $rate), JSON_UNESCAPED_UNICODE));
		}
	}
	
}
