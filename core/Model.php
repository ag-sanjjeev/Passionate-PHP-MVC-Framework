<?php

namespace app\core;

use app\core\Database;

/**
 * Class Model
 *
 * This is a model class file. Which has methods for handling database for respective model
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */
class Model extends Database
{
	/**
	 * The value of table name
	 * Potential value will be valid table name that should exist in database
	 *
	 * @var string $table
	 */
	protected static string $table = "";

	/**
	 * The value of primaryKey by default
	 * Potential value will be valid primary key that should exist in table
	 *
	 * @var string $primaryKey
	 */
	protected static string $primaryKey = "id";
	
	/**
	 * The value of table columns
	 * Potential value will be valid column name that should exist in table
	 *
	 * @var array $fillable
	 */
	protected static array $fillable = [];	

	/**
	 * The value of all fillable as dynamic property
	 *
	 * @var array $d
	 */
	public static array $d = [];

	/**
	 * It will return all records from $table
	 *
	 * @author ag-sanjjeev 
	 * @return table records
	 */

	function __construct() 
	{
		/*
			Initiating parent constructor to use their uninitialized properties
		*/
		parent::__construct();	

		/*
			Initiating or overwriting properties from child class whenever it is extended
		*/
		$this->initProperties();
	}

	/**
	 * Initiates class properties from child class
	 *
	 * @author ag-sanjjeev 
	 */
	protected function initProperties()
	{
		/*
			Checking for whether table property allocated or not.
			Otherwise it will get from tableName method
		*/
		if (isset(static::$table) && !empty(static::$table)) {

			self::$table = static::$table ?? self::$table;

		} else {

			self::$table = $this->tableName();

		}

		/*
			If it may be an empty throws an exception
		*/
		if (empty(self::$table)) {
			throw new \Exception("Table is not found or given", 1);
			exit();
		}

		/*
			Checking for whether fillable property allocated or not.
			Otherwise it will get from tableColums method
		*/
		if (isset(static::$fillable) && !empty(static::$fillable)) {

			self::$fillable = static::$fillable ?? self::$fillable;

		} else {

			self::$fillable = $this->tableColums();

		}

		/*
			If it may be an empty throws an exception
		*/
		if (empty(self::$fillable)) {
			throw new \Exception("Table column is not found or given", 1);
			exit();
		}

	}

	/**
	 * Magic method for setting dynamic properties
	 *	 
	 * @author ag-sanjjeev 
	 *
	 */
	public function _set($name, $value)
	{
		$this->d[$name] = $value;
	}

	/**
	 * Magic method for getting dynamic properties
	 *	 
	 * @author ag-sanjjeev 
	 * @return $d[$name]
	 *
	 */
	public function _get($name)
	{
		return $this->d[$name] ?? null;
	}

	/**
	 * Get class name for which of the class is extends it. 
	 * This may be a valid tablename property
	 *
	 * @author ag-sanjjeev 
	 * @return table records
	 */
	protected function tableName()
	{	
		$tableName = get_called_class();

		/*
			Extract class name alone by excluding the namespace string
		*/
		$tableName = array_reverse(explode('\\', $tableName))[0];

		/*
			Makes it to be a lower case for a valid class name structure
		*/
		$tableName = strtolower($tableName);

		return $tableName;
	}

	/**
	 * Get table columns name
	 *
	 * @author ag-sanjjeev 
	 * @return $tableColumns	 
	 */
	protected function tableColums()
	{	
		/*
			Query for getting information about table
		*/
		$query = "DESCRIBE " . self::$table;

		/*
			Executing the query
		*/
		$prepare = $this->query($query);

		/*
			Fetching all the record
		*/
		$records = $prepare->fetchAll();

		$tableColums = [];
		
		/*
			Extracting column names alone
		*/
		foreach ($records as $key => $value) {
			array_push($tableColums, $value['Field']);
		}

		return $tableColums;
	}

	/**
	 * Get all record for the table
	 *
	 * @author ag-sanjjeev 
	 * @return array	 
	 */
	public function all()
	{	
		/*
			Query for selecting all record
		*/
		$query = "SELECT * FROM " . self::$table;	

		/*
			Executing the query
		*/	
		$prepare = $this->query($query);		

		return $prepare->fetchAll();
	}

	/**
	 * Get specific record from the table by primary key
	 *
	 * @param primary key $id this must be a primary key of the table
	 * @author ag-sanjjeev 
	 * @return array
	 */
	public function find($id)
	{	
		/*
			Throws an exception if the primary key value gets empty
		*/
		if (empty($id)) {
			throw new \Exception("Primary key is not present in finding a record from " . self::$table, 1);
			exit();
		}

		/*
			Creating values array for positional query execution
		*/
		$primaryKey = ':' . self::$primaryKey;
		$values = array(
			$primaryKey => $id
		);

		/*
			Query for selecting specific record by primary key
		*/
		$query = "SELECT * FROM " . self::$table . " WHERE " . self::$primaryKey . "=:" . self::$primaryKey;

		/*
			Executing the query with prepared data
		*/
		$prepare = $this->query($query, $values);		

		return $prepare->fetchAll();
	}

	/**
	 * Create record in the table with given data
	 *
	 * @param record array $record this must be an array of values with associative index
	 * @author ag-sanjjeev 	 
	 */
	public function create($record)
	{	
		/*
			Query for create record in table
		*/
		$query = "INSERT INTO " . self::$table;

		/*
			Extracting record keys
		*/
		$fields = array_keys($record);

		/*
			Extracting record values
		*/
		$values = array_values($record);
		
		/*
			Combining into string as groupFields
		*/
		$groupFields = implode(",", $fields);

		/*
			Combining into string as prepareFields
		*/
		$prepareFields = ":" . implode(",:", $fields);
		
		/*
			Finalizing the query
		*/
		$query .= '(' . $groupFields . ')' . " VALUES " . '(' . $prepareFields . ')';

		/*
			Creating array of positional index with value
		*/
		$prepareValues = array();
		foreach ($record as $key => $value) {
			$newKey = ':' . $key;
			$prepareValues[$newKey] = $value;
		}

		/*
			Executing the query with prepared data
		*/
		$prepare = $this->query($query, $prepareValues);
		
	}

	/**
	 * Updating record in the table by a primary key
	 *
	 * @param primary key $id this must be a primary key of the table
	 * @param record array $record this must be an array of values with associative index
	 * @author ag-sanjjeev 	 
	 */
	public function update($id, $record)
	{	
		/*
			Query for updating record
		*/
		$query = "UPDATE " . self::$table . " SET ";

		/*
			Extracting record keys
		*/
		$fields = array_keys($record);

		/*
			Extracting record values
		*/
		$values = array_values($record);
		
		/*
			Preparing query for positional parameters
		*/
		foreach ($record as $key => $value) {
			$query .= "$key=:$key, ";
		}

		/*
			Trimming for any whitespaces
		*/
		$query = trim($query);

		/*
			Trimming for any trailing comma
		*/
		$query = trim($query, ',');

		$query .= " WHERE " . self::$primaryKey . "=:" . self::$primaryKey;
		
		/*
			Preparing for positional array of values for prepared query
		*/
		$prepareValues = array();
		
		foreach ($record as $key => $value) {
		
			$newKey = ':' . $key;
			$prepareValues[$newKey] = $value;

		}
		
		$primaryKeyIndex = ':' . self::$primaryKey;
		$prepareValues[$primaryKeyIndex] = $id;

		/*
			Executing the query with prepared data
		*/
		$prepare = $this->query($query, $prepareValues);
	}

	/**
	 * Deleting record from the table by a primary key
	 *
	 * @param primary key $id this must be a primary key of the table	 
	 * @author ag-sanjjeev 	 
	 */
	public function delete($id)
	{
		/*
			Throws an exception if the primary key value is not exist
		*/
		if (empty($id)) {
			throw new \Exception("Primary key should not an empty", 1);
			exit();
		}

		/*
			Query for deleting record from the table
		*/
		$query = "DELETE FROM " . self::$table . " WHERE " . self::$primaryKey . "=:" . self::$primaryKey;

		/*
			Preparing the positional array of value for prepared query
		*/
		$prepareValues = array();

		$primaryKeyIndex = ':' . self::$primaryKey;

		$prepareValues[$primaryKeyIndex] = $id;

		/*
			Executing the query with prepared data
		*/
		$prepare = $this->query($query, $prepareValues);

	}

}