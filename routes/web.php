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

Route::get('/view-akad-create', ['middleware' => ['ability:admin|buat-akad-role,buat-akad'], 'uses' => 'AkadController@view_create'])->name('view-akad-create');
Route::get('/view-akad-list', ['middleware' => ['ability:admin|lihat-akad-role,lihat-akad'], 'uses' => 'AkadController@view_list'])->name('view-akad-list');
Route::get('/view-akad-monitor', ['middleware' => ['ability:admin|pantau-akad-role,pantau-akad'], 'uses' => 'AkadController@view_edit'])->name('view-akad-monitor');
Route::get('/view-akad-edit/{id}', ['middleware' => ['ability:admin|ubah-akad-role|hapus-akad-role,ubah-akad|hapus-akad'], 'uses' => 'AkadController@view_edit'])->name('view-akad-edit');
Route::get('/view-admin-users', ['middleware' => ['ability:admin|lihat-pengguna-role,lihat-pengguna'], 'uses' => 'AdminController@view_users'])->name('view-admin-users');

Route::post('/crud-akad-create', ['middleware' => ['ability:admin|buat-akad-role,buat-akad'], 'uses' => 'AkadController@crudcreate'])->name('crud-akad-create');
Route::get('/crud-akad-list', ['middleware' => ['ability:admin|lihat-akad-role,lihat-akad'], 'uses' => 'AkadController@crud_list'])->name('crud-akad-list');
Route::post('/crud-akad-edit', ['middleware' => ['ability:admin|ubah-akad-role|hapus-akad-role,ubah-akad|hapus-akad'], 'uses' => 'AkadController@crud_edit'])->name('crud-akad-edit');
Route::post('/crud-akad-comment-create', ['middleware' => ['ability:admin|buat-komentar-role,buat-komentar'], 'uses' => 'AkadController@crud_comment_create'])->name('crud-akad-comment-create');
Route::post('/crud-admin-users-edit', ['middleware' => ['ability:admin|ubah-pengguna-role,ubah-pengguna'], 'uses' => 'AdminController@crud_users_edit'])->name('crud-admin-users-edit');
