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
    return view('welcome_me');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/view-akad-create', 'AkadController@view_create')->name('view-akad-create');
Route::get('/crud-akad-create', 'AkadController@crud_create')->name('crud-akad-create');
