<?php

namespace app\models;

use app\core\Model;

/**
 * Class Users extending from model
 *
 * This is a users class file. Which is used to handle model related with table in database
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */
class Users extends Model
{
	/**
	 * The value of table name that can be overwritten here
	 * Potential value will be a valid table name that should exist in database
	 *
	 * @var string $table
	 */
	protected static string $table = "users";

	/**
	 * The value of table column names to be accessed that can be overwritten here
	 * Potential value will be a valid array of table columns
	 *
	 * @var array $fillable
	 */
	protected static array $fillable = ['id', 'fullname', 'emailid', 'password', 'hash_id'];	
	
}