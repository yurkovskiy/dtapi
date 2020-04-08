<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model_Auth_User {
	
	protected $_table_columns = array(
			"id" => array(
					"type" => "int",
					"column_name" => "id"
			),
			"email" => array(
					"type" => "string",
					"column_name" => "email"
			),
			"username" => array(
					"type" => "string",
					"column_name" => "username"
			),
			"password" => array(
					"type" => "string",
					"column_name" => "password"
			),
			"logins" => array(
					"type" => "string",
					"column_name" => "logins"
			),
			"last_login" => array(
					"type" => "string",
					"column_name" => "last_login"
			)
	);
	
	public function list_columns()
	{
		return $this->_table_columns;
	}
	
}

