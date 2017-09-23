<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('admin', ['middleware' => 'auth', function () {
    return view('admin_template');
}]);

Route::auth();

// Route::get('/home', 'HomeController@index');

Route::get('/', 'AdminController@home');

Route::post('/modal_create', 'AdminController@modal_create');
Route::post('/modal_edit', 'AdminController@modal_edit');
Route::post('/modal_delete', 'AdminController@modal_delete');
Route::post('/do_create', 'AdminController@do_create');    
Route::post('/do_edit/{id}', 'AdminController@do_edit');
Route::post('/do_delete', 'AdminController@do_delete');
Route::get('/chartjs', 'AdminController@chartjs');
// Route::post('/deleteData/{id}', 'AdminController@delete');