<?php

Route::set('/', 'HomeController', 'index');
Route::set('about', 'AboutController', 'index');
Route::set('users/register', 'UserController', 'create');
Route::set('users/login', 'UserController', 'login');
Route::set('users/logout', 'UserController', 'logout');
Route::set('posts', 'PostController', 'index');
Route::set('posts/create', 'PostController', 'create');
Route::set('posts/show', 'PostController', 'show');
Route::set('posts/edit', 'PostController', 'edit');
Route::set('posts/delete', 'PostController', 'delete');
Route::set('tasks', 'TaskController', 'index');
Route::set('tasks/create', 'TaskController', 'create');
Route::set('tasks/show', 'TaskController', 'show');
Route::set('tasks/edit', 'TaskController', 'edit');
Route::set('tasks/delete', 'TaskController', 'delete');