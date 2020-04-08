<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model_Auth_User {
	
	protected $_table_columns = array("id" => "", "email" => "", "username" => "", "password" => "", "logins" => "", "last_login" => "");
	
}

