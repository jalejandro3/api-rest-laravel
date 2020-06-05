<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * AUTH
 */
Route::post('auth/login', ['uses' => 'AuthController@login']);

/**
 * USER
 */
Route::get('me', ['uses' => 'UserController@getUserData']);

/**
 * TASKS
 */
Route::get('tasks', ['uses' => 'TaskController@all']);
Route::post('tasks', ['uses' => 'TaskController@createTask']);
Route::get('tasks/user', ['uses' => 'TaskController@getTasksByUser']);
Route::get('tasks/{id}', ['uses' => 'TaskController@getTaskById']);
