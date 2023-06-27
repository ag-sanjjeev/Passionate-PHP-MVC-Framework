<?php


namespace app\core;

/**
 * Class Configuration
 *
 * This is a configuration class file. Which has all major and important credentials
 * for this project to work properly.
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */
class Configuration
{
	/**
	 * The value of dsn
	 * Potential value of this will be as per PDO requirement
	 * 
	 * @var string $dsn
	 */
	public static string $dsn = "";

	/**
	 * The value of database username to access it
	 * Potential value will be valid username of database connection
	 *
	 * @var string $dbuser
	 */
	public static string $dbuser = "";

	/**
	 * The value of database password for the respective username
	 * Potential value will be safe and secure password of that matched credentials
	 *
	 * @var string $dbpassword
	 */
	public static string $dbpassword = "";

	/**
	 * The value of host which this holds application's database
	 * Potential value will be valid url
	 *
	 * @var string $host
	 */
	public static string $host = "";

	/**
	 * The value of database name to handle information associated with this application
	 * Potential value will be valid database name that should exists
	 *
	 * @var string $dbname
	 */
	public static string $dbname = "";

	/**
	 * The value of app name to be used through out the application
	 * Potential value will be required and suitable name for the projects
	 *
	 * @var string $appName
	 */
	public static string $appName = "";

	/**
	 * The value of app version to identify which version of the app is working
	 * Potential value will be valid version
	 *
	 * @var string $appVersion
	 */
	public static string $appVersion = "";

	/**
	 * The value of app environment which can be used to run this application in
	 * different working environment.
	 * Potential values are ['production', 'debug', 'dev']
	 *
	 * @var string $appEnvironment
	 */
  	public static string $appEnvironment = "";

  	/**
	 * Assignment of property values inside this constructor method executes
	 *	 
	 * @author ag-sanjjeev <resulttext>	 
	 *
	 */
	public function __construct()
	{
		self::$dbuser 			= "root";
		self::$dbpassword 		= "";
		self::$dbname 			= "php_mvc";
		self::$host 			= "localhost:3306";
		self::$dsn 				= "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";";
	}
}