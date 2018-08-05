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



/* Route::get('/members', function () {

   return view('member.member');

});*/
  Route::get('/savings', function () {


   return view('savings.savings');

});


    //codes

  Route::get('/codes_registration', function () {


   return view('codes.registration');

});
         
              //category
   Route::get('/category', function () {


   return view('category.index');

});
 
   //induarance

  Route::get('/insurances', function () {

    return view('Insurance.insurance');

});


   Route::get('/penalties', function () {

    return view('Penalty.penalties');

});


     Route::get('/tax', function () {

    return view('tax.index');

})->name('tax');
   
       
        //interest method

    Route::get('/interest_methods', function () {

    return view('Methods.method');

});


    Route::get('/Glaccount', function () {

    return view('category.accounts')->name('Glaccount');
});

      Route::get('/categoryaccountstypes', function () {

    return view('category.accountstypes');
})->name('categoryaccountstypes');


   Route::get('/main_accounts', function () {

    return view('category.main');
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
})->name('shares');
  
           //reports button in nav
     Route::get('/reports', function () {

   return view('reports.home');
});

  /* Route::get('/profile/{id}/membersavings', function () {

   return view('savings.membersavings');
});*/


   //membershare
  /* Route::get('', function () {

   return view('shares.membershares');
});*/

   Route::get('interestmethod','MembersProfileController@interestmethod')->name('interestmethod');

 

   
Auth::routes();

Route::get('/profile/{id}/membersavings','SavingsController@membersavings')->name('membersavings');
Route::get('/profile/{id}/member_allsavings','SavingsController@member_allsavings')->name('member_allsavings');


Route::get('/profile/{id}/membershares','SharesController@membershare')->name('memberShares');
Route::get('/profile/{id}/member_allshares','SharesController@member_allshare')->name('member_allshare');

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/memberRegister','MembersController@index')->name('memberRegister');
Route::get('/members','MembersController@index')->name('members');
Route::get('/member/edit/{id}','MembersController@edit')->name('member.edit');
Route::post('/member/update/{id}','MembersController@update')->name('member.update');
Route::get('member/delete/{id}','MembersController@delete')->name('member.delete');
Route::get('/memberRegister','MembersController@registerform')->name('registerform');
Route::post('saveregister','MembersController@saveregister')->name('saveregister');
Route::get('/gettax','TaxesControllers@gettax')->name('gettax');

Route::get('/profile/{mprofileid}','MembersProfileController@cover')->name('profile');
Route::get('/profile/{id}/newloan','MembersProfileController@newloan')->name('newloan');
//Route::get('/profile/{id}/editloan/{lid}','MembersProfileController@editloan')->name('editloan');;
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
Route::get('/ajaxreceivepayment/{id}','MembersProfileController@ajaxreceivepayment')->name('ajaxreceivepayment');
Route::post('/payment','MembersProfileController@storepayments');

  //reports
  Route::get('/reports/loans','ReportsController@loansshow');
  Route::get('/reports/members','ReportsController@membersshow');
  
        //loans
   Route::get('/drafted_loans','loansController@drafted_loans')->name('drafted_loans');
   Route::get('/drafted/edit/{id}','loansController@editloan')->name('drafted.edit');
   Route::post('/drafted/update/{id}','loansController@update')->name('drafted.update');
   Route::get('/drafted/delete/{id}','loansController@delete')->name('drafted.delete');
  Route::get('newloans_received','loansController@newloans_received');
  Route::get('/loan_info/{id}','loansController@loan_info')->name('loan_info');
  Route::get('/pending_loans','loansController@appended_loans');
  Route::get('/rejected_loans','loansController@rejected_loans');
  Route::get('/approved_loans','loansController@approved_loans');
  Route::get('/paid_loans','loansController@paid_loans');
  Route::get('/ready_vouchers','loansController@ready_vouchers')->name('ready_vouchers');


  
   Route::post('/draft_submitted','loansController@draft_submitted');
   Route::get('/submit/{id}','loansController@submit')->name('submit');
  Route::get('/agree/{id}','loansController@agree')->name('agree');
  Route::get('approve_voucher/{id}','loansController@approve_voucher')->name('approve_voucher');
  Route::get('/paid/{id}','loansController@paid')->name('paid');
  Route::get('/voucher{id}','loansController@voucher')->name('voucher');
  Route::post('/agree_submitted','loansController@agree_submitted');
  Route::post('approve_voucher_submitted','loansController@approve_voucher_submitted')->name('approve_voucher_submitted');
  Route::post('/paid_submitted','loansController@paid_submitted')->name('paid_submitted');

 Route::get('/reject/{id}','loansController@reject')->name('reject');
 Route::post('/reject_submitted','loansController@reject_submitted');

 Route::get('/pending/{id}','loansController@pending')->name('pending');
 Route::post('/pending_submitted','loansController@pending_submitted');
 Route::post('/voucher_submitted','loansController@voucher_submitted');


 //isuarance by ajax
 Route::get('/insuarance','InsurancesController@index')->name('insurance');
 Route::get('interestmethods','InterestmethodsController@index')->name('interestmethods');
 Route::get('processed_loans','loansController@processed_loans')->name('processed_loans');
 Route::get('/unpaid_vouchers','loansController@unpaid_vouchers');

         //penalty

 Route::get('/penalty','PenaltyController@index')->name('penalty');
                  //codes
 Route::get('/codes','CodeController@index')->name('codes');
 Route::get('/Accategory','CategoryaccountController@index')->name('category');
 Route::get('accountstypes','CategoryaccountController@accountstypes')->name('accountstypes');
 Route::get('/accounts','GlaccountController@index')->name('accounts');
 Route::get('/mainaccounts','MainaccountController@index')->name('mainaccounts');

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


   //print
 Route::get('/paidloans_slip/{id}','loansController@paidloans_slip')->name('paidloans_slip');
 Route::get('/member/{id}','MemberinfoController@dashboard');
 Route::get('/repayment_slip/{member_id}/{amountinput}/{getpaymenttype}','MembersProfileController@repayment_slip')->name('repayment_slip');




          //member account 
  Route::get('/member/{id}/savings','MemberinfoController@savings');
  Route::get('/member/{id}/shares','MemberinfoController@shares');
  Route::get('/member/{id}/collaterals','MemberinfoController@collaterals');
  Route::get('/member/{id}/loans','MemberinfoController@loans');
  Route::get('/member/{id}/loan_info/{lid}','MemberinfoController@loan_info');



        //finacial reports

    Route::get('/income_statments','ReportsController@income_statments');
    Route::get('/balance_sheets','ReportsController@balance_sheets')->name('balance_sheets');
    Route::post('/duration_incomestatment','ReportsController@duration_incomestatment')->name('duration_incomestatment');
    Route::post('/findbalance_sheets','ReportsController@findbalance_sheets')->name('findbalance_sheets');
    Route::get('/printcheck','LoansController@printcheck')->name('printcheck');
    Route::get('/printdispatch','LoansController@printdispatch')->name('printdispatch');
    Route::get('viewcheckprint','LoansController@viewcheckprint');
    Route::get('/Expenses','MainaccountController@expenses')->name('expenses');
    Route::get('expenseajax','MainaccountController@expenseajax')->name('expenseajax');
    Route::post('/storeexpenses','MainaccountController@storeexpenses')->name('storeexpenses');

 

 


  