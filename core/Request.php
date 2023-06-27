<?php

namespace app\core;

/**
 * Class Request
 *
 * This is a request class file. Which has all essential details of each and
 * every request arisen from the client.
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */
class Request
{

	/**
	 * The value of requested url path
	 * 
	 * @var string $urlPath
	 */
	public static string $urlPath = "";

	/**
	 * The value of request method
	 *
	 * @var string $methodRequest
	 */
	public static string $methodRequest = "";

	/**
	 * The value of all data from request
	 *
	 * @var array $inputs
	 */
	public static array $inputs = [];

	/**
	 * This will evaluate all request and collects essential information of the request     
     *
     * @author ag-sanjjeev <resulttext>	
     *
	 */
	public function __construct()
	{
		self::$urlPath 			= 	$this->urlRequest();
		self::$methodRequest	= 	$this->methodRequest();
		self::$inputs 			= 	$this->inputsFromRequest();
	}

	/**
	 * This will short-out requested url and eliminates any other url parameter
	 *
	 * @param directory $path this must be a project directory location	 
	 * 
	 * @return urlPath
	 * @author ag-sanjjeev <resulttext>
	 *
	 */

	public function urlRequest()
	{
		$urlPath = $_SERVER['REQUEST_URI'] ?? '/';

		/*
			Checking any other url parameter exists and if it is not present then return urlPath
		*/
		$position = strpos($urlPath, '?');

		if ($position === false) {
			return $urlPath;
		}

		$urlPath = substr($urlPath, 0, $position);
		return $urlPath;
	}

	/**
	 * This will get information about method of the request
	 *
	 * @return methodRequest
	 * @author ag-sanjjeev <resulttext>
	 *
	 */
	public function methodRequest()
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}

	/**
	 * This will checks whether it is get method or not
	 *
	 * @return boolean
	 * @author ag-sanjjeev <resulttext>
	 * 
	 */
	public function isGet()
	{
		return $this->methodRequest() === 'get';
	}

	/**
	 * This will checks whether it is post method or not
	 *
	 * @return boolean
	 * @author ag-sanjjeev <resulttext>
	 * 
	 */
	public function isPost()
	{
		return $this->methodRequest() === 'post';
	}

	/**
	 * This will collect all data from the request
	 *
	 * @return inputs
	 * @author ag-sanjjeev <resulttext>
	 *
	 */
	public function inputsFromRequest()
	{
		$data = [];

		/*
			collects all data if it is a get request method
		*/
		if ($this->isGet()) {
			foreach ($_GET as $key => $value) {
				$data[$key] = $value;
			}
		}

		/*
			collects all data if it is a post request method
		*/
		if ($this->isPost()) {
			foreach ($_POST as $key => $value) {
				$data[$key] = $value;
			}
		}

		return $data;
	}
}