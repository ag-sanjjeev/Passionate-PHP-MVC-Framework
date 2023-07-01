<?php

namespace app\core;

use \PDO as PDO;
use app\core\Configuration;

/**
 * Class Database
 * 
 * This is a database class. The database connection will be establiished from here.
 * This uses configuration class properties for credentials
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */
class Database
{
	/**
	 * The typed property value of PDO class
	 * Potential value will be pdo object
	 *
	 * @var PDO $pdo
	 */
	public PDO $pdo;

	/**
	 * The typed property value of configuration class
	 * Potential value will be object of the class
	 *
	 * @var Configuration $config	 
	 */
	public Configuration $config;

	/**
	 * Establishing database connection based on credentials 
	 *	 
	 * @author ag-sanjjeev <resulttext>	 
	 *
	 */
	public function __construct()
	{
		$this->config 			= 	new Configuration;


		$dsn 					= 	$this->config::$dsn;
		$dbuser 				=	$this->config::$dbuser;
		$dbpassword 			= 	$this->config::$dbpassword;
		$appEnvironment 		= 	$this->config::$appEnvironment;
		
		$this->pdo 				= 	new PDO($dsn, $dbuser, $dbpassword);

		/*
			This conditional statement will checks for application environment. If it is not an empty and not a production then it will sets PDO attributes for error mode exceptions
		*/
		if (!empty($appEnvironment) && $appEnvironment !== "production") {
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}

	/**
	 * Query method is used for execute raw queries
	 *	 
	 * @param query string $query this must be a query string
	 * @param field values array $values this must be a positional value for query
	 * @author ag-sanjjeev <resulttext>
	 * @return $prepare
	 *
	 */
	public function query($query, $values = array())
	{		
		$prepare = $this->pdo->prepare($query);
		$prepare->execute($values);

		return $prepare;
	}
}