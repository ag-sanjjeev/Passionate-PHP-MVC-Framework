<?php

namespace app\controllers;

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
}