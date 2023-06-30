<?php

namespace app\core;

/**
 * Class Application
 *
 * This is an application class file. Which has control of functionalities and 
 * features for the Model View Controller architecture.
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */

class Application
{
	/**
	 * The value of root directory for this application
	 * Potential values are based on assignment
	 * 
	 * @var string $ROOT_DIR
	 */
	public static string $ROOT_DIR = "";

	/**
	 * The typed property value of application class reference 
     * Potential value will be object of the class
     *
     * @var Application $app
	 */
	public static Application $app;

	/**
	 * The typed property value of configuration class
	 * Potential value will be object of the class
	 *
	 * @var Configuration $config	 
	 */
	public Configuration $config;

	/**
	 * The typed property value of Controller class
	 * Potential value will be object of the class
	 *
	 * @var Controller $controller
	 */
	public Controller $controller;

	/**
	 * The typed property value of route class
	 * Potential value will be object of the class
	 *
	 * @var Route $route	 
	 */
	public Route $route;

	/**
	 * The typed property value of Database class
	 * Potential value will be object of the class
	 *
	 * @var Database $db
	 */
	public Database $db;

	/**
	 * The typed property value of Request class
	 * Potential value will be object of the class
	 *
	 * @var Request $request
	 */
	public Request $request;

	/**
	 * Initiating various entry point for functionalities and features 
	 *	 
	 * @author ag-sanjjeev <resulttext>	 
	 *
	 */
	public function __construct()
	{
		self::$app 					= 	$this;

		$this->config 				= 	new Configuration;

		// $this->db 					= 	new Database;

		$this->request 				= 	new Request;

		// $this->controller 			= 	new Controller;

		$this->route 				= 	new Route;



	}

	/**
	 * Sets the value for $ROOT_DIR property
	 *
	 * @param directory $path this must be a project directory location	 
	 *
	 * @author ag-sanjjeev <resulttext>
	 *
	 */
	public function setRootPath($path = '')
	{
		self::$ROOT_DIR = $path;
	}	

	/**
	 * This will point to routes establishment  
	 *
	 * @author ag-sanjjeev <resulttext>
	 *
	 */
	public function run()
	{
		$this->route->establish();
	}
}