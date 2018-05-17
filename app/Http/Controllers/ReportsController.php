<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\Collateral;
use App\Loaninsuarance;
use App\Loanschedule;
use App\Repayment;
use App\Membersaving;
use App\Feescategory;
use App\Member_share;
use App\Share;
use App\Interestmethod;
use Carbon\Carbon;

class ReportsController extends Controller
{
    //

     public function loansshow(){

    /*SELECT  COUNT(loans.id) as no_loans, SUM(mounthlyrepayment_amount) as totalamount FROM `loans` ORDER BY `mounthlyrepayment_amount` ASC*/

       

         

            
       
     	 return view('reports.loans',compact('loans'));
     }

      public function membersshow(){

     	 return view('reports.members');
     }
}


