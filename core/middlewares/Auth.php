<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\helpers\Auth as AuthHelper;

class Auth extends AuthHelper
{
	
	function __construct()
	{
		parent::__construct();
		
		if($this->isGuest()) {
			Application::$app->response->setStatusCode(403);
			throw new \Exception("You are not allowed here", 1);
			exit();
		}
	}
}