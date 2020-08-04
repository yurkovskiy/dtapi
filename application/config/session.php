<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
		'native' => array(
				'name' => 'session_name',
				'lifetime' => 43200,
		),
		'cookie' => array(
				'name' => 'cookie_name',
				'encrypted' => TRUE,
				'lifetime' => 43200,
		),
		'database' => array(
				'name' => 'session_id',
				'encrypted' => FALSE,
				'lifetime' => 43200,
				'group' => 'default',
				'table' => 'sessions',
				'columns' => array(
						'session_id'  => 'session_id',
						'last_active' => 'last_active',
						'contents'    => 'contents'
				),
				'gc' => 500,
		),
);