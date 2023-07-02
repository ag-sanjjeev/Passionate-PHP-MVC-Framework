<?php

use app\core\Route;
use app\controllers\Democontroller;

Route::get('/', function() {
	return [1,2,3];
});

Route::get('/home', function() {
	return 'Welcome';
});

Route::any('/test', 'test');

Route::get('/demo', [Democontroller::class, 'index'])->middleware('auth');

Route::any('/user/{$username}/posts/{$id}', [Democontroller::class, 'postPage']);

Route::get('/user/{$username}/posts/{$id}', [Democontroller::class, 'postPage']);

Route::get('/another/{$var}', function($var) {
	return $var;
});