<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['uservalidate'], function() {
    Route::get('/categories', 'Api\CategoriesController@index');
    Route::post('/categories/add', 'Api\CategoriesController@add');
    Route::get('/tasklists', 'Api\TasksController@index');
    Route::get('/tasklists/{id}', 'Api\TasksController@lists');
    Route::post('/tasks/add', 'Api\TasksController@add');
    Route::post('/uploads/import', 'Api\UploadsController@import');
});
