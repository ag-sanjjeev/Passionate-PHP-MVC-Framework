<?php

namespace app\core;

/**
 * Class Session
 *
 * This is a session class file. Which has all session related methods
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */
class Session
{
	/**
	 * The value of current session id
	 * Potential value will be only session id
	 *
	 * @var string $session_id
	 */
	public static string $session_id = "";

	/**
	 * The value of session flash for reflash
	 * Potential value will be copy of flash
	 *
	 * @var $session_flash
	 */
	protected static $session_flash;

	function __construct()
	{
		/*
			Starting session
		*/
		session_start();

		/*
			Assigning current session id
		*/
		self::$session_id = session_id();
	}

	/**
	 * Setting session value
	 *
	 * @param session name $name this is an associative index of session value
	 * @param session value $value this is a value to be stored against name
	 * @author ag-sanjjeev <resulttext>
	 *
	 */
	public function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	/**
	 * Getting session value
	 *	
	 * @param session name $name this is an associative index of session value
	 * @author ag-sanjjeev <resulttext>
	 * @return session value
	 *
	 */
	public function get($name)
	{		
		return $_SESSION[$name] ?? null;		
	}

	/**
	 * Regenerates session id
	 *
	 * @author ag-sanjjeev <resulttext>
	 */
	public function regenerate()
	{
		self::$session_id = session_regenerate_id();
	}

	/**
	 * Emptying only specific session value from session
	 *
	 * @param session name $name this is an associative index of session value
	 * @author ag-sanjjeev <resulttext>
	 */
	public function unsetOnly($name)
	{
		if (!empty($name)) {
			unset($_SESSION[$name]);
		}
	}

	/**
	 * Emptying entire session value from session
	 *
	 * @author ag-sanjjeev <resulttext>
	 */
	public function unset()
	{
		session_unset();
	}

	/**
	 * Destroys the session
	 *
	 * @author ag-sanjjeev <resulttext>
	 */
	public function destroy()
	{
		session_destroy();
	}

	/**
	 * Setting and getting session flash. that available until next redirection
	 * 
	 * @param session name $name this is an associative index of session value
	 * @param session value $value this is a value to be stored against name 
	 * @author ag-sanjjeev <resulttext>
	 * @return session value or nothing	 
	 */
	public function flash($name, $value = '')
	{
		if (!empty($value)) {
			$_SESSION['flash'][$name] = $value;
			return;
		} else {
			$flash = $_SESSION['flash'][$name] ?? null;
			
			if (!is_null($flash)) {
				self::$session_flash = $flash;
				$this->unsetFlash();
			}
			return $flash;
		}
	}

	/**
	 * Maintains the session flash for the further requests
	 * It need to call after accessing session flash before any redirections
	 *
	 * @author ag-sanjjeev <resulttext>
	 */
	public function reflash()
	{
		$_SESSION = self::$session_flash;
	}

	/**
	 * Emptying entire session flash
	 *
	 * @author ag-sanjjeev <resulttext>
	 */
	public function unsetFlash()
	{
		unset($_SESSION['flash']);
	}
}