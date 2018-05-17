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

Route::get('/table33', function () {
   return view('table');

})->middleware('auth');

 Route::get('/members', function () {

   return view('member.member');

})->middleware('auth');
  Route::get('/savings', function () {


   return view('savings.savings');

})->middleware('auth');


  Route::get('/loanCategory', function () {

    return view('LoanCategory.form');

})->middleware('auth');

   Route::get('/loan_fee', function () {

    return view('fee.fee');

})->middleware('auth');

     Route::get('profile/{id}/collateral', function () {

    return view('collateral.index');

})->middleware('auth');
 
  Route::get('/shares', function () {

   return view('shares.shares');
})->middleware('auth');
  
           //reports button in nav
     Route::get('/reports', function () {

   return view('reports.home');
})->middleware('auth');

   Route::get('/profile/{id}/membersavings', function () {

   return view('savings.membersavings');
})->middleware('auth');


   //membershare
   Route::get('/profile/{id}/membershares', function () {

   return view('shares.membershares');
})->middleware('auth');

   Route::get('interestmethod','MembersProfileController@interestmethod')->name('interestmethod');

 

   
Auth::routes();

Route::get('/membersavings/{id}','SavingsController@membersavings');

Route::get('/memberShares/{id}','SharesController@membershare');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/memberRegister','MembersController@index')->name('memberRegister')->middleware('auth');
Route::get('/profile/{mprofileid}','MembersProfileController@cover')->name('profile')->middleware('auth');
Route::get('/profile/{id}/newloan','MembersProfileController@newloan')->name('newloan')->middleware('auth');
Route::get('/profile/{id}/editloan/{lid}','MembersProfileController@editloan')->name('editloan')->middleware('auth');
Route::get('/profile/{id}/schedule/{lid}','MembersProfileController@schedule')->name('schedule')->middleware('auth');
Route::get('/profile/{id}/loanlist','MembersProfileController@loanlist')->name('loanlist')->middleware('auth');

Route::get('/interest','MembersProfileController@interest')->name('interest');
Route::get('/membercollateral','MembersProfileController@membercollateral')->name('membercollateral');
Route::get('/loancharges','MembersProfileController@loancharges')->name('loancharges');
Route::get('/guarantors','MembersProfileController@guarantors')->name('guarantors');
Route::post('/memberloan','MembersProfileController@createloan')->middleware('auth');
Route::post('/updateloan','MembersProfileController@updateloan')->middleware('auth');


Route::get('/shareCreate','SharesController@index')->name('shareCreate')->middleware('auth');
Route::get('/savingCreate','SavingsController@index')->name('savingCreate')->middleware('auth');

Route::get('/table','TableController@table')->name('table');

Route::get('/loancat','LoancategoriesController@index')->name('loancat')->middleware('auth');
Route::get('/fee_category','LoancategoriesController@fee_category')->name('fee_category')->middleware('auth');


Route::get('/collat/{id}','CollateralsController@index')->name('collat')->middleware('auth');
Route::get('/loan','LoanController@index')->name('loan')->middleware('auth');
         
           //pdf download
Route::get('/pdf_download/{principle}/{interest}/{period}/{firstpayment}','MembersProfileController@pdfview')->name('pdfview');
Route::get('/profile/{id}/payment','MembersProfileController@payment')->middleware('auth');;
Route::post('/payment','MembersProfileController@storepayments');

  //reports
  Route::get('/reports/loans','ReportsController@loansshow');
  Route::get('/reports/members','ReportsController@membersshow');



  