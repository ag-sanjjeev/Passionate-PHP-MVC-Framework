<?php

/**
 * Application entry point
 *
 * This is an entry point for all request and response of this project.
 * This file will be autoloads of all core functionalities and features at top.
 * Application class has initiated and assign $ROOT_DIR property from here.
 * Which is used for initiating application by executing run method.
 *
 * PHP version 8.1.2
 *
 * LICENSE: This source file is subject to license that is available through the repository
 * at https://github.com/ag-sanjjeev. If you did not receive a complete copy of it.
 * Then get it from the above url has mentioned. Please send a note through the author via contact details found in README for any changes made in this project. For any other
 * instructions to be followed as per license. And it can be found in this project.
 *
 * @category Framework
 * @package main
 * @author ag-sanjjeev 
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since This is available since Release 1.0
 */

// Implementing autoloading
require_once __DIR__ . './../vendor/autoload.php';

// Using App\Core Namespace
use app\core\Application;

// Getting Application Root Path
$rootPath = dirname(__DIR__);

// Initiating Application
$app = new Application();

// Setting root directory for the project
$app->setRootPath($rootPath);

// Initiating application by calling run method
$app->run();

