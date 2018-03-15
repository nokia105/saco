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


 Route::get('/members', function () {


   return view('member.member');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/memberRegister','MembersController@index')->name('memberRegister');

Route::get('/table','TableController@table')->name('table');
Route::get('/loanCategory','LoancategoriesController@index');
Route::post('/loanCategory','LoancategoriesController@store');



  