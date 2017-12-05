<?php defined ( 'SYSPATH' ) or die ( 'No direct script access.' );

/**
 * Admin User Controller for handle AJAX requests
 */
class Controller_AdminUser extends Controller {
	
	private $ROOT_ID = 1; // the main admin of the system
	
	protected $ADMIN_ROLE = "admin";
	
	public function before()
	{
		if (!Auth::instance()->logged_in($this->ADMIN_ROLE))
		{
			throw new HTTP_Exception_403( "You don't have permissions to work with this Entity" );
		}
		else 
		{
			parent::before();
		}
	}
	
	public function action_insertData() 
	{
		// Read POST data in JSON format
		$params = @json_decode($this->request->body());
		
		// check if input data is given
		if (is_null($params) || (!is_object($params)))
		{
			throw new HTTP_Exception_400("No input data");
		}
			
		// Convert Object into Array
		$paramsArr = get_object_vars($params);
			
		// Register user
		$model = null;
		try {
			$model = ORM::factory("User")->create_user($paramsArr, array('username', 'password', 'email'));
			$this->response->body(json_encode(array("id" => $model->id, "username" => $model->username, "email" => $model->email)));
		} catch (ORM_Validation_Exception $e) {
			throw new HTTP_Exception_400($e->getMessage());
		}
					
		// Add roles for new user
		$model->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
		$model->add('roles', ORM::factory('role')->where('name', '=', 'admin')->find());
		
	}
	
	public function action_update()
	{
		$record_id = $this->request->param("id");
				
		// get info from client
		$params = json_decode($this->request->body());
		$paramsArr = get_object_vars($params);
			
		try {
			// get record for update
			$model = ORM::factory("User", $record_id)->update_user($paramsArr);
			$this->response->body(json_encode(array("response" => "ok")));
		} catch (ORM_Validation_Exception $e) {
			throw new HTTP_Exception_400($e->getMessage());
		}

	}
	
	public function action_del()
	{
		// get record_id from URL
		$record_id = $this->request->param("id");
		
		// get current logged user id
		$user_id = Auth::instance()->get_user()->id;
		
		// check record_id and user id
		if ($record_id == $user_id)
		{
			throw new HTTP_Exception_400("Error: Cannot erase infomration about oneself");
		}
		
		// check for ROOT_ID (we can delete this user)
		if ($record_id == $this->ROOT_ID)
		{
			throw new HTTP_Exception_403("Error: Cannot erase information about main ROOT user");
		}
		
		try {
			$model = ORM::factory("User", $record_id);
			// get roles for checking
			$roles = $model->roles->find_all();
			$rolesArray = array();
			foreach ($roles as $role)
			{
				array_push($rolesArray, $role->name);
			}
			unset($roles);
			
			// We can delete admin users only using this Controller
			if (!in_array($this->ADMIN_ROLE, $rolesArray))
			{
				throw new HTTP_Exception_403("Cannot erase non admin users using this kind of request");				
			}
			
			$model->delete();
			$this->response->body(json_encode(array("response" => "ok")));
		} catch (Kohana_Exception $e) {
			throw new HTTP_Exception_400($e->getMessage());
		}
	}
	
	public function action_getRecords()
	{
		$result = array();
		$model = null;
		$record_id = $this->request->param("id");
		if (isset($record_id))
		{
			$model = ORM::factory("User", $record_id)->as_array();
		}
		else
		{
			$model = ORM::factory("User")
				->join("roles_users")
				->on("user_id", "=", "user.id")
				->where("role_id", "=", "2")
				->find_all();
		}
		
		$fieldNames = ORM::factory("User")->list_columns();
		
		if (isset($record_id))
		{
			if (!is_null($model["id"])) 
			{
				array_push($result, $model);
			}
			
		}
		else 
		{
			foreach ($model as $user)
			{
				$item = array();
				foreach ($fieldNames as $fieldName) 
				{
					$item[$fieldName["column_name"]] = $user->{$fieldName["column_name"]};
				}
				array_push($result, $item);
			}
		}
		
		if (count($result) < 1)
		{
			$result["response"] = "no records";
		}
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
	}
	
	public function action_getRecordsRange()
	{
		$limit = $this->request->param("id");
		$offset = $this->request->param("id1");
		
		$model = null;
		$result = array();
		
		// check input parameters
		if ((!is_numeric($limit)) || (!is_numeric($offset)) || ($limit < 0) || ($offset < 0))
		{
			throw new HTTP_Exception_400("Wrong request");
		}
		else 
		{
			$model = ORM::factory("User")
				->join("roles_users")
				->on("user_id", "=", "user.id")
				->where("role_id", "=", "2")
				->limit($limit)
				->offset($offset)
				->find_all();
		}
		$fieldNames = ORM::factory("User")->list_columns();
		
		foreach ($model as $user)
		{
			$item = array();
			foreach ($fieldNames as $fieldName)
			{
				$item[$fieldName["column_name"]] = $user->{$fieldName["column_name"]};
			}
			array_push($result, $item);
		}
		
		if (count($result) < 1)
		{
			$result["response"] = "no records";
		}
		
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
		
	}
	
	public function action_countRecords()
	{
		$model = ORM::factory("User")
			->join("roles_users")
			->on("user_id", "=", "user.id")
			->where("role_id", "=", "2")
			->count_all();
		$this->response->body(json_encode(array("numberOfRecords" => $model), JSON_UNESCAPED_UNICODE));
	}
	
	public function action_getLastRecordId()
	{
		$model = ORM::factory("User")
			->join("roles_users")
			->on("user_id", "=", "user.id")
			->where("role_id", "=", "2")
			->order_by("user.id", "DESC")
			->limit(1)
			->find();
		$this->response->body(json_encode(array("lastRecordId" => $model->id), JSON_UNESCAPED_UNICODE));
	}
	
	public function action_getRecordsBySearch()
	{
		$result = array();
		
		$criteria = $this->request->param("id");
		$fieldNames = ORM::factory("User")->list_columns();
		$model = ORM::factory("User")
			->join("roles_users")
			->on("user_id", "=", "user.id")
			->where("role_id", "=", "2")
			->and_where("username", "LIKE", "%".$criteria."%")
			->find_all();
		
		foreach ($model as $user)
		{
			$item = array();
			foreach ($fieldNames as $fieldName)
			{
				$item[$fieldName["column_name"]] = $user->{$fieldName["column_name"]};
			}
			array_push($result, $item);
		}
		
		if (count($result) < 1)
		{
			$result["response"] = "no records";
		}
		
		$this->response->body(json_encode($result, JSON_UNESCAPED_UNICODE));
	}
	
	/**
	 * Helper function for checking uniqueness
	 * @param string $field
	 * @param string $value
	 * 
	 * @return JSON {"response": true/false}
	 */
	protected function checkUniqueness($field, $value)
	{
		$model = ORM::factory("User")->where($field, "=", $value)->count_all();
		$response = ($model === 1) ? true : false;
		$this->response->body(json_encode(array("response" => $response), JSON_UNESCAPED_UNICODE));
	}
	
	/**
	 * Method for checking uniqueness of username (can use for Admin/Student usernames)
	 * @name checkUserName
	 * @param string username (by GET request /{})
	 * @return JSON true - if the username is already present at DB or false if not
	 * @throws HTTP_Exception_400
	 */
	public function action_checkUserName()
	{
		$username = $this->request->param("id");
		if (is_null($username))
		{
			throw new HTTP_Exception_400("Wrong input data");
		}
		else 
		{
			$this->checkUniqueness("username", $username);
		}
	}
	
	/**
	 * Method for checking uniqueness of email (can use for Admin/Student email)
	 * @name checkEmailAddress
	 * @param string email (by GET request /{})
	 * @return JSON true - if the email is already present at DB or false if not
	 * @throws HTTP_Exception_400
	 */
	public function action_checkEmailAddress()
	{
		$email = $this->request->param("id");
		if (is_null($email))
		{
			throw new HTTP_Exception_400("Wrong input data");
		}
		else
		{
			$this->checkUniqueness("email", $email);
		}
	}
}
