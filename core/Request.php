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
	 * @var string $method
	 */
	public static string $method = "";

	/**
	 * The value of all data from request
	 *
	 * @var array $input
	 */
	public static array $input = [];

	/**
	 * The value of all data from request as dynamic property
	 *
	 * @var array $d
	 */
	public static array $d = [];

	/**
	 * This will evaluate all request and collects essential information of the request     
     *
     * @author ag-sanjjeev <resulttext>	
     *
	 */
	public function __construct()
	{
		self::$urlPath 			= 	$this->url();
		self::$method 			= 	$this->method();
		self::$input 			= 	$this->initInput();
	}

	/**
	 * Magic method for setting dynamic properties
	 *	 
	 * @author ag-sanjjeev <resulttext>
	 *
	 */
	public function _set($name, $value)
	{
		$this->d[$name] = $value;
	}

	/**
	 * Magic method for getting dynamic properties
	 *	 
	 * @author ag-sanjjeev <resulttext>
	 * @return $d[$name]
	 *
	 */
	public function _get($name)
	{
		return $this->d[$name] ?? null;
	}

	/**
	 * This will collect all data from the request
	 *
	 * @author ag-sanjjeev <resulttext>
	 * @return $data
	 *
	 */
	public function initInput()
	{
		$data = [];

		/*
			Collects all data if it is a get request method
			and Sets dynamic property of this class
		*/
		if ($this->isGet()) {
			foreach ($_GET as $key => $value) {
				$data[$key] = $value;
				$this->$key = $value;
			}
		}

		/*
			Collects all data if it is a post request method
			and Sets dynamic property of this class
		*/
		if ($this->isPost()) {
			foreach ($_POST as $key => $value) {
				$data[$key] = $value;
				$this->$key = $value;
			}
		}		

		return $data;
	}

	/**
	 * This will short-out requested url and eliminates any other url parameter
	 *
	 * @author ag-sanjjeev <resulttext>
	 * @return urlPath
	 *
	 */
	public function url()
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
	 * This will return full url with it's parameters
	 *
	 * @author ag-sanjjeev <resulttext>
	 * @return fullUrlPath
	 *
	 */
	public function fullUrl()
	{
		$urlPath = $_SERVER['REQUEST_URI'] ?? '/';
		$serverName = $_SERVER['SERVER_NAME'] ?? '';
		$serverPort = $_SERVER['SERVER_PORT'] ?? '';
		
		$fullUrlPath = $serverName . ":$serverPort" . $urlPath;

		return $fullUrlPath;
	}

	/**
	 * This will check whether givern url string matches with the request url
	 *
	 * @param url $urlName this is url string
	 * @author ag-sanjjeev <resulttext>
	 * @return bool
	 *
	 */
	public function is($urlName = '')
	{
		/*
			Getting the current url and trimming trailing slashes
		*/
		$url = $this->url();
		$url = trim($url, '/');

		/*
			Getting position of * symbol from $urlName and Length of the $urlName
		*/
		$pos = strpos($urlName, "*");
		$length = strlen($urlName);

		/*
			Trimming trailing slashes
		*/
		$urlName = trim($urlName, '*');
		$urlName = trim($urlName, '/');

		/*
			If the * symbol is not given then it matches with exactly what it is
		*/
		if ($pos === false) {
			return ($url === $urlName);
		}

		/*
			If the * symbol found at end of the $urlName then 
			It matches whether it start with value of $urlName string to the $url
		*/
		if (($pos+1) === $length) {
			return strpos($url, $urlName) === 0;
		}

		/*
			If the * symbol found at starting of the $urlName then 
			It matches whether it end with value of $urlName string to the $url
		*/
		if (($pos) === 0) {
			return strpos($url, $urlName) > 0;	
		}

	}

	/**
	 * This will collect ip address of requested user and returns it
	 *
	 * @author ag-sanjjeev <resulttext>
	 * @return ipAddress
	 *
	 */
	public function ip()
	{
		if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
			return $_SERVER['REMOTE_ADDR'];
		}

		return null;
	}

	/**
	 * This will get information about method of the request
	 *
	 * @author ag-sanjjeev <resulttext>
	 * @return method
	 *
	 */
	public function method()
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}

	/**
	 * This will checks whether it is get method or not
	 *
	 * @author ag-sanjjeev <resulttext>
	 * @return boolean
	 * 
	 */
	public function isGet()
	{
		return $this->method() === 'get';
	}

	/**
	 * This will checks whether it is post method or not
	 *
	 * @author ag-sanjjeev <resulttext>
	 * @return boolean
	 * 
	 */
	public function isPost()
	{
		return $this->method() === 'post';
	}	

	/**
	 * This will return collected input as per requirement
	 *
	 * @author ag-sanjjeev <resulttext>
	 * @return $data
	 *
	 */
	public function input($inputName='')
	{
		$data = self::$input;

		/*
			If any inputName request and that value will be return
			otherwise returns null
		*/
		if (!empty($inputName)) {
			return $data[$inputName] ?? null;	
		}

		return $data;
	}

	/**
	 * This will return only specific inputs as per requirements
	 *
	 * @param inputNames $onlyInputs This is combination input names
	 * @author ag-sanjjeev <resulttext>
	 * @return array	 
	 *
	 */
	public function only($onlyInputs)
	{
		$data = array();
		$input = self::$input;

		if (is_string($onlyInputs)) {
			$onlyInputs = explode(',', $onlyInputs);
		}

		foreach ($onlyInputs as $key => $value) {
			$keyValue = trim($value);
			if (array_key_exists($keyValue, $input)) {
				$data[$keyValue] = $input[$keyValue];
			}
		}

		return $data;
	}

	/**
	 * This will return except specific inputs as per requirements
	 *
	 * @param inputNames $exceptInputs This is combination of input names
	 * @author ag-sanjjeev <resulttext>
	 * @return array	 
	 *
	 */
	public function except($exceptInputs = '')
	{
		$input = self::$input;

		/*
			If $exceptInputs is not present then it will return all input
		*/
		if (empty($exceptInputs)) {
			return $input;
		}

		if (is_string($exceptInputs)) {
			$exceptInputs = explode(',', $exceptInputs);
		}

		/*
			If any of the $exceptInputs presents in the $input keys then
			It will remove from $input
		*/
		foreach ($exceptInputs as $key => $value) {
			$keyValue = trim($value);
			if (array_key_exists($keyValue, $input)) {
				unset($input[$keyValue]);
			}
		}

		return $input;
	}

	/**
	 * This will check for all of the input key exist in the input
	 *
	 * @param InputNames $hasInput This is combination of input names
	 * @author ag-sanjjeev <resulttext>
	 * @return bool
	 *
	 */
	public function has($hasInput)
	{
		$input = self::$input;

		if (is_string($hasInput)) {
			$hasInput = explode(',', $hasInput);
		}

		foreach ($hasInput as $key => $value) {
			$keyValue = trim($value);
			if (!array_key_exists($keyValue, $input)) {
				return false;
			}
		}

		return true;

	}

	/**
	 * This will check for any of the input key exist in the input
	 *
	 * @param InputNames $hasInput This is combination of input names
	 * @author ag-sanjjeev <resulttext>
	 * @return bool
	 *
	 */
	public function hasAny($hasInput)
	{
		$input = self::$input;

		if (is_string($hasInput)) {
			$hasInput = explode(',', $hasInput);
		}

		foreach ($hasInput as $key => $value) {
			$keyValue = trim($value);
			if (array_key_exists($keyValue, $input)) {
				return true;
			}
		}

		return false;

	}

	/**
	 * This will check for all of the input is not an empty
	 * And if the input name is not exist in the $input then it will be false
	 *
	 * @param InputNames $inputName This is combination of input names
	 * @author ag-sanjjeev <resulttext>
	 * @return bool
	 *
	 */
	public function filled($inputName)
	{
		$input = self::$input;

		if (is_string($inputName)) {
			$inputName = explode(',', $inputName);
		}
		
		foreach ($inputName as $key => $value) {
			$keyValue = trim($value);
			
			if (isset($input[$keyValue]) && empty($input[$keyValue])) {
				return false;
			} elseif(!isset($input[$keyValue])) {
				return false;
			}
		}

		return true;

	}

	/**
	 * This will check for any of the input is not an empty
	 * And if the input name is not exist in the $input then it will be false
	 *
	 * @param InputNames $inputName This is combination of input names
	 * @author ag-sanjjeev <resulttext>
	 * @return bool
	 *
	 */
	public function filledAny($inputName)
	{
		$input = self::$input;

		if (is_string($inputName)) {
			$inputName = explode(',', $inputName);
		}
		
		foreach ($inputName as $key => $value) {
			$keyValue = trim($value);
			
			if (isset($input[$keyValue]) && !empty($input[$keyValue])) {
				return true;
			}
		}

		return false;

	}

	/**
	 * This will check for any of the input key is not exist in the input
	 *
	 * @param InputNames $missingInput This is combination of input names
	 * @author ag-sanjjeev <resulttext>
	 * @return bool
	 *
	 */
	public function missing($missingInput)
	{
		$input = self::$input;

		if (is_string($missingInput)) {
			$missingInput = explode(',', $missingInput);
		}

		foreach ($missingInput as $key => $value) {
			$keyValue = trim($value);
			if (!array_key_exists($keyValue, $input)) {
				return true;
			}
		}

		return false;

	}

	/**
	 * Get all acceptable content types for the request
	 *
	 * @author ag-sanjjeev <resulttext>
	 * @return array 
	 *
	 */
	public function acceptableContentTypes()
	{
		$contentTypes = $_SERVER['HTTP_ACCEPT'] ?? '';

		return explode(',', $contentTypes);

	}

	/**
	 * It will checks whether the request accepts given contentTypes
	 *
	 * @param contents $contentTypes The combination content types
	 * @author ag-sanjjeev <resulttext>
	 * @return bool 
	 *
	 */
	public function accepts($contentTypes)
	{
		$acceptables = $_SERVER['HTTP_ACCEPT'] ?? '';
		$acceptables = explode(',', $acceptables);
		
		if (is_string($contentTypes)) {
			$contentTypes = explode(',', $contentTypes);
		}

		/*
			If any of the $contentTypes is not present in $acceptable then 
			it will return false
		*/
		foreach ($contentTypes as $key => $value) {
			if (!in_array(trim($value), $acceptables)) {
				return false;
			}
		}

		return true;

	}

}