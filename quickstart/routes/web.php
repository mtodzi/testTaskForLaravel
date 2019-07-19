<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');
Route::match(['post','get'],'/positions', 'PositionController@index');
Route::get('/position/{id}', 'PositionController@view');
Route::match(['post','get'],'/newposition', 'PositionController@create');
Route::match(['post','get'],'/updatposition/{id}', 'PositionController@update');
Route::delete('/position/{id}', 'PositionController@destroy');
Route::match(['post','get'],'/workers', 'WorkersController@index');
Route::match(['post','get'],'/newworkers', 'WorkersController@create');
Route::get('/worker/{id}', 'WorkersController@view');
Route::get('/deleteworkersphoto/{id}', 'WorkersController@deletephoto');
Route::match(['post','get'],'/updateworkers/{id}', 'WorkersController@update');
Route::match(['post','get'],'/updateworkersphoto/{id}', 'WorkersController@updatephoto');
Route::delete('/worker/{id}', 'WorkersController@destroy');
Route::match(['post','get'],'/ajaxpositions', 'AjaxPositionController@index');
Route::post('/ajaxnewpost', 'AjaxPositionController@create');
Route::post('/ajaxupdateposition', 'AjaxPositionController@update');
Route::delete('/ajaxdeleteposition', 'AjaxPositionController@destroy');
Route::match(['post','get'],'/ajaxworkers', 'AjaxWorkersController@index');
Route::post('/ajaxupdateworker', 'AjaxWorkersController@update');
Route::post('/ajaxupdateworkerphoto', 'AjaxWorkersController@updatePhoto');
Route::post('/ajaxdeleteworkerphoto', 'AjaxWorkersController@deletePhoto');
Route::post('/ajaxupdateworkerposition', 'AjaxWorkersController@updatePosition');
Route::post('/ajaxindexmodal', 'AjaxPositionController@indexModal');
Route::post('/ajaxindexnewworker', 'AjaxPositionController@indexNewWorker');
Route::match(['post','get'],'/ajaxworkersnewworker', 'AjaxWorkersController@indexNewWorker');
Route::post('/creatajaxworker', 'AjaxWorkersController@Create');
Route::post('/ajaxhomeworkers', 'HomeController@GetWorkers');