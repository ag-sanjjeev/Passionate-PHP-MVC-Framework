<?php

use app\core\Route;

Route::get('/', function() {
	return [1,2,3];
});

Route::get('/home', function() {
	return 'Welcome';
});

Route::any('/test', 'test');