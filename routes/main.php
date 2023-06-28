<?php

use app\core\Route;

Route::get('/', function() {
	echo 'Hello';
});

Route::any('/test', 'test');