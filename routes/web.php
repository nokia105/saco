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


  Route::get('/loanCategory', function () {

    return view('LoanCategory.form');

})->middleware('auth');

     Route::get('/collateral', function () {

    return view('collateral.index');

})->middleware('auth');
 
  Route::get('/shares', function () {


   return view('shares.shares');

})->middleware('auth');

    Route::get('/loanview', function () {


   return view('loans.newloan');

})->middleware('auth');


   
Auth::routes();

Route::get('/membersavings','MemberProfileController@savings');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/memberRegister','MembersController@index')->name('memberRegister')->middleware('auth');
Route::get('/profile/{id}','MemberProfileController@index')->name('profile')->middleware('auth');
Route::get('/shareCreate','SharesController@index')->name('shareCreate')->middleware('auth');
Route::get('/savingCreate','SavingsController@index')->name('savingCreate')->middleware('auth');

Route::get('/table','TableController@table')->name('table');
Route::get('/loancat','LoancategoriesController@index')->name('loancat')->middleware('auth');
Route::get('/collat','CollateralsController@index')->name('collat')->middleware('auth');
Route::get('/loan','LoanController@index')->name('loan')->middleware('auth');

//Route::get('/loans','LoanController@index');

//Route::post('/loanCategory','LoancategoriesController@store')->middleware('auth');


/*   return view('shares.shares');

})->middleware('auth');*/
/*Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/memberRegister','MembersController@index')->name('memberRegister');
Route::get('/savingCreate','SavingsController@index')->name('savingCreate');
Route::get('/shareCreate','SharesController@index')->name('shareCreate');
Route::get('/table','TableController@table')->name('table');
Route::get('/loanCategory','LoancategoriesController@index');*/




  