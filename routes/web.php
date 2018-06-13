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


    //codes

  Route::get('/codes_registration', function () {


   return view('codes.registration');

})->middleware('auth');
 
   //induarance

  Route::get('/insurances', function () {

    return view('Insurance.insurance');

})->middleware('auth');


   Route::get('/penalties', function () {

    return view('Penalty.penalties');

})->middleware('auth');
       
        //interest method

    Route::get('/interest_methods', function () {

    return view('Methods.method');

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
Route::get('/membercollateral','MembersProfileController@membercollateral')->name('members')->middleware('auth')->name('membercollateral');
Route::get('/loancharges','MembersProfileController@loancharges')->name('members')->middleware('auth')->name('loancharges');
Route::get('/guarantors','MembersProfileController@guarantors')->name('members')->middleware('auth')->name('guarantors');
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
Route::get('/profile/{id}/payment','MembersProfileController@payment')->middleware('auth');
Route::post('/payment','MembersProfileController@storepayments');

  //reports
  Route::get('/reports/loans','ReportsController@loansshow')->middleware('auth');
  Route::get('/reports/members','ReportsController@membersshow')->middleware('auth');
  
        //loans

  Route::get('newloans_received','loansController@newloans_received')->middleware('auth');
  Route::get('/newloan_receive/{id}','loansController@newloan_receive')->middleware('auth');
  Route::get('/pending_loans','loansController@appended_loans')->name('members')->middleware('auth');
  Route::get('/rejected_loans','loansController@rejected_loans')->name('members')->middleware('auth');
  Route::get('/approved_loans','loansController@approved_loans')->name('members')->middleware('auth');

  Route::get('/approve/{id}','loansController@approve')->name('approve')->name('members')->middleware('auth');
  Route::post('/approve_submitted','loansController@approve_submitted')->name('members')->middleware('auth');

 Route::get('/reject/{id}','loansController@reject')->name('reject')->name('members')->middleware('auth');
 Route::post('/reject_submitted','loansController@reject_submitted')->name('members')->middleware('auth');

 Route::get('/pending/{id}','loansController@pending')->name('pending')->name('members')->middleware('auth');
 Route::post('/pending_submitted','loansController@pending_submitted')->name('members')->middleware('auth');


 //isuarance by ajax
 Route::get('/insuarance','InsurancesController@index')->name('insurance');
 Route::get('/interestmethods','InterestmethodsController@index')->name('members')->middleware('auth');

         //penalty

 Route::get('/penalty','PenaltyController@index')->name('members')->middleware('auth')->name('penalty');
                  //codes
 Route::get('/codes','CodeController@index')->name('members')->middleware('auth')->name('codes');


 Route::get('reports/loans_month','ReportsController@loans_month')->name('members')->middleware('auth');
 Route::post('reports/loans_month','ReportsController@retrive_loans_month')->name('members')->middleware('auth');
 Route::get('reports/loans_time_range','ReportsController@loans_time_range')->name('members')->middleware('auth');
 Route::post('reports/loans_time_range','ReportsController@retrive_loans_time_range')->name('members')->middleware('auth');

 Route::get('reports/expected_profit','ReportsController@expected_profit')->name('members')->middleware('auth');
 Route::post('reports/retrive_expected_profit','ReportsController@retrive_expected_profit')->name('members')->middleware('auth');

 Route::get('/admin','Admincontroller@index');

  Route::get('member/login','Auth\MemberloginController@showLoginForm');
  Route::post('member/login','Auth\MemberloginController@login')->name('member.login');

 Route::resource('Admin_member','AdminmemberController');
 Route::resource('permissions','permissionController');
 Route::resource('roles','RoleController');