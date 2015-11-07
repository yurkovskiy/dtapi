<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Abstract Controller class for RESTful controller mapping. Supports GET, PUT,
 * POST, and DELETE. By default, these methods will be mapped to these actions:
 *
 * GET
 * :  Mapped to the "index" action, lists all objects
 *
 * POST
 * :  Mapped to the "create" action, creates a new object
 *
 * PUT
 * :  Mapped to the "update" action, update an existing object
 *
 * DELETE
 * :  Mapped to the "delete" action, delete an existing object
 *
 * Additional methods can be supported by adding the method and action to
 * the `$_action_map` property.
 *
 * [!!] Using this class within a website will require heavy modification,
 * due to most web browsers only supporting the GET and POST methods.
 * Generally, this class should only be used for web services and APIs.
 *
 * @package    Kohana
 * @category   Controller
 * @author     Kohana Team
 * @copyright  (c) 2009-2010 Kohana Team
 * @license    http://kohanaframework.org/license
 */
abstract class Controller_REST extends Controller {
	/**
	 * @var  array  REST types - with supported HTTP methods
	 */
	protected $_action_map = array
	(
		HTTP_Request::GET    => 'index',
		HTTP_Request::PUT    => 'update',
		HTTP_Request::POST   => 'create',
		HTTP_Request::DELETE => 'delete'
	);
	/**
	 * @var  string  requested action
	 */
	protected $_action_requested = '';
	
	/**
	 * The request's parameters.
	 *
	 * @var array
	 */
	protected $_params;
	
	/**
	 * Checks the requested method against the available methods. If the method
	 * is supported, sets the request action from the map. If not supported,
	 * the "invalid" action will be called.
	 */
	public function before()
	{
		$this->_action_requested = $this->request->action();
		$method = $this->request->method();
		if ( ! isset($this->_action_map[$method]))
		{
			$this->request->action = 'invalid';
		}
		else
		{
			$this->request->action($this->_action_map[$method]);
		}
		$this->_init_params();
	}
	/**
	 * Sends a 405 "Method Not Allowed" response and a list of allowed actions.
	 */
	public function action_invalid()
	{
		// Send the "Method Not Allowed" response
		$this->request->status = 405;
		$this->request->headers['Allow'] = implode(', ', array_keys($this->_action_map));
	}
	
	/**
	 * Initializes the request params array based on the current request.
	 * @TODO support other exotic methods.
	 */
	private function _init_params()
	{
		$this->_params = array();
		switch ($this->request->method())
		{
			case HTTP_Request::POST:
			case HTTP_Request::PUT:
			case HTTP_Request::DELETE:
				if (isset($_SERVER['CONTENT_TYPE']) && false !== strpos($_SERVER['CONTENT_TYPE'], 'application/json'))
				{
					$parsed_body = json_decode($this->request->body(), true);
				}
				else
				{
					parse_str($this->request->body(), $parsed_body);
				}
				$this->_params = array_merge((array) $parsed_body, (array) $this->request->post());
				// No break because all methods should support query parameters by default.
			case HTTP_Request::GET:
				$this->_params = array_merge((array) $this->request->query(), $this->_params);
				break;
			default:
				break;
		}
	}
} // End REST