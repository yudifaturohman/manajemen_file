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

/*
Route::get('/', function () {
    return view('auth.login');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::post('/home', 'HomeController@store')->name('home.store');
Route::get('/home/{id}', 'HomeController@show')->name('home.show');

Route::resource('guru', 'GuruController');
Route::resource('manage_user', 'UserController');
Route::resource('file', 'ManajemenFile');

Route::post('upload', 'ManajemenFile@upload')->name('file.upload');
Route::post('/emailsend', 'ManajemenFile@sendMail')->name('email.kirim');
Route::get('/file/{filetitle}/download', 'ManajemenFile@download');
Route::get('/liat/{filetitle}', 'ManajemenFile@showFile');
Route::get('/file/{id}/hapusFile', 'ManajemenFile@hapusFile');
Route::get('/email/{id}', 'ManajemenFile@email');

Route::get('/register/{id}', 'GuruController@register')->name('guru.register');
Route::post('/register', 'GuruController@addUser')->name('guru.addUser');