<?php

namespace app\core\helpers;

use app\core\Application;
/**
 * 
 */
class Auth 
{
	public $session;
	public $cookie;

	function __construct()
	{
		$this->session = Application::$app->session;

		$this->cookie = Application::$app->cookie;
	}

	public function isGuest()
	{
		$authStatus = $this->session->get('auth.status') ?? 'guest' ;

		return $authStatus === 'guest';
	}

}