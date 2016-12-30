<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->POST('/auth/login', 'AuthController@loginPost');


/* User Router */

$app->GET('/users', 'UserController@index');
$app->GET('/users/{id}', 'UserController@show');
$app->POST('/users', 'UserController@create');
$app->PUT('/users/{id}', 'UserController@update');
$app->DELETE('/users/{id}', 'UserController@destroy');

$app->POST('/users/{user_id}/tasks/{task_id}', 'UserController@assign_task');
$app->GET('/users/{id}/tasks/', 'UserController@user_tasks');


/* Priority Router */

$app->GET('/priorities', 'PriorityController@index');
$app->GET('/priorities/{id}', 'PriorityController@show');
$app->POST('/priorities', 'PriorityController@create');
$app->PUT('/priorities/{id}', 'PriorityController@update');
$app->DELETE('/priorities/{id}', 'PriorityController@destroy');


/* Task Router */

$app->GET('/tasks', 'TaskController@index');
$app->GET('/tasks/{id}', 'TaskController@show');
$app->POST('/tasks', 'TaskController@create');
$app->PUT('/tasks/{id}', 'TaskController@update');
$app->DELETE('/tasks/{id}', 'TaskController@destroy');

$app->POST('/tasks/{task_id}/users/{user_id}', 'TaskController@assign_user');
$app->GET('/tasks/{id}/users/', 'TaskController@task_users');
