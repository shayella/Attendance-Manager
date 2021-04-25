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

Route::resource('/faculty','FacultyController');
Route::resource('/batch','BatchClassController');
Route::resource('/student','StudentsController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/attendance/{id}', 'StudentsController@attendance');
Route::get('/admin', 'AdminController@index')->middleware('auth');
Route::get('/admin/classes', 'AdminController@allClasses')->middleware('auth');
Route::get('/import', 'ImportExcelController@index')->middleware('auth');
Route::post('/import', 'ImportExcelController@import')->middleware('auth');
