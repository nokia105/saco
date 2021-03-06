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


    /*return view('welcome');*/
    return view('member.member');

})->name('members')->middleware('auth');

 Route::get('/members', function () {

   return view('member.member');

})->middleware('auth');
  Route::get('/savings', function () {


   return view('savings.savings');

})->middleware('auth');
  Route::get('/shares', function () {


   return view('shares.shares');

})->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/memberRegister','MembersController@index')->name('memberRegister');
Route::get('/savingCreate','SavingsController@index')->name('savingCreate');
Route::get('/shareCreate','SharesController@index')->name('shareCreate');
Route::get('/table','TableController@table')->name('table');
Route::get('/loanCategory','LoancategoriesController@index');
Route::post('/loanCategory','LoancategoriesController@store');
Route::resource('/loans','LoansController');


  