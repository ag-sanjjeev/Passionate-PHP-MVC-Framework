<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\helpers;
use app\models\Users;
use app\core\Database;

/**
 * 
 */
class Democontroller extends Controller
{
	
	public function index(Request $request, Response $response)
	{				
		return $response->view('subdirectory\test2', ['userName' => 'guest', 'title' => 'demo']);
	}

	public function postPage(Request $request, Response $response, $username, $id)
	{
		echo $response->view('subdirectory\test2', ['userName' => $username, 'title' => 'demo']);
	}
}