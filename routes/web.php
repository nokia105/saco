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

})->name('members')->middleware('auth:member');

Route::get('/table33', function () {
   return view('table');

});

 Route::get('/members', function () {

   return view('member.member');

});
  Route::get('/savings', function () {


   return view('savings.savings');

});


    //codes

  Route::get('/codes_registration', function () {


   return view('codes.registration');

});
 
   //induarance

  Route::get('/insurances', function () {

    return view('Insurance.insurance');

})->middleware('auth');


   Route::get('/penalties', function () {

    return view('Penalty.penalties');

});
       
        //interest method

    Route::get('/interest_methods', function () {

    return view('Methods.method');

});



  Route::get('/loanCategory', function () {

    return view('LoanCategory.form');

});

   Route::get('/loan_fee', function () {

    return view('fee.fee');

});

     Route::get('profile/{id}/collateral', function () {

    return view('collateral.index');

});
 
  Route::get('/shares', function () {

   return view('shares.shares');
});
  
           //reports button in nav
     Route::get('/reports', function () {

   return view('reports.home');
});

   Route::get('/profile/{id}/membersavings', function () {

   return view('savings.membersavings');
});


   //membershare
   Route::get('/profile/{id}/membershares', function () {

   return view('shares.membershares');
});

   Route::get('interestmethod','MembersProfileController@interestmethod')->name('interestmethod');

 

   
Auth::routes();

Route::get('/membersavings/{id}','SavingsController@membersavings');

Route::get('/memberShares/{id}','SharesController@membershare');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/memberRegister','MembersController@index')->name('memberRegister');
Route::get('/profile/{mprofileid}','MembersProfileController@cover')->name('profile');
Route::get('/profile/{id}/newloan','MembersProfileController@newloan')->name('newloan');
Route::get('/profile/{id}/editloan/{lid}','MembersProfileController@editloan')->name('editloan');;
Route::get('/profile/{id}/schedule/{lid}','MembersProfileController@schedule')->name('schedule');
Route::get('/profile/{id}/loanlist','MembersProfileController@loanlist')->name('loanlist');

Route::get('/interest','MembersProfileController@interest')->name('interest');
Route::get('/membercollateral','MembersProfileController@membercollateral')->name('membercollateral');
Route::get('/loancharges','MembersProfileController@loancharges')->name('loancharges');
Route::get('/guarantors','MembersProfileController@guarantors')->name('guarantors');
Route::post('/memberloan','MembersProfileController@createloan');
Route::post('/updateloan','MembersProfileController@updateloan');


Route::get('/shareCreate','SharesController@index')->name('shareCreate');
Route::get('/savingCreate','SavingsController@index')->name('savingCreate');

Route::get('/table','TableController@table')->name('table');

Route::get('/loancat','LoancategoriesController@index')->name('loancat');
Route::get('/fee_category','LoancategoriesController@fee_category')->name('fee_category');


Route::get('/collat/{id}','CollateralsController@index')->name('collat');
Route::get('/loan','LoanController@index')->name('loan')->middleware('auth');
         
           //pdf download
Route::get('/pdf_download/{principle}/{interest}/{period}/{firstpayment}','MembersProfileController@pdfview')->name('pdfview');
Route::get('/profile/{id}/payment','MembersProfileController@payment');
Route::post('/payment','MembersProfileController@storepayments');

  //reports
  Route::get('/reports/loans','ReportsController@loansshow');
  Route::get('/reports/members','ReportsController@membersshow');
  
        //loans

  Route::get('newloans_received','loansController@newloans_received');
  Route::get('/newloan_receive/{id}','loansController@newloan_receive');
  Route::get('/pending_loans','loansController@appended_loans');
  Route::get('/rejected_loans','loansController@rejected_loans');
  Route::get('/approved_loans','loansController@approved_loans');

  Route::get('/approve/{id}','loansController@approve')->name('approve');
  Route::post('/approve_submitted','loansController@approve_submitted');

 Route::get('/reject/{id}','loansController@reject')->name('reject');
 Route::post('/reject_submitted','loansController@reject_submitted');

 Route::get('/pending/{id}','loansController@pending')->name('pending');
 Route::post('/pending_submitted','loansController@pending_submitted');


 //isuarance by ajax
 Route::get('/insuarance','InsurancesController@index')->name('insurance');
 Route::get('/interestmethods','InterestmethodsController@index');

         //penalty

 Route::get('/penalty','PenaltyController@index')->name('penalty');
                  //codes
 Route::get('/codes','CodeController@index')->name('codes');


 Route::get('reports/loans_month','ReportsController@loans_month');
 Route::post('reports/loans_month','ReportsController@retrive_loans_month');
 Route::get('reports/loans_time_range','ReportsController@loans_time_range');
 Route::post('reports/loans_time_range','ReportsController@retrive_loans_time_range');

 Route::get('reports/expected_profit','ReportsController@expected_profit');
 Route::post('reports/retrive_expected_profit','ReportsController@retrive_expected_profit');
 

  Route::get('member/login','Auth\MemberloginController@showLoginForm');

  Route::post('member/login','Auth\MemberloginController@login')->name('member.login');
 // Route::post('member/logout','Auth\MemberloginController@logout')->name('member.logout');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::resource('Admin_member','AdminmemberController');
 //Route::get('/admin','Admincontroller@index');
 Route::resource('permissions','permissionController');
 Route::resource('roles','RoleController');

 