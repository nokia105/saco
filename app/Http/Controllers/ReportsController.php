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
use DB;
use App\Code;
use App\Monthpenaty;
use App\Month;
use App\Year;

class ReportsController extends Controller
{
    //

     public function loans_month(){
                 
        /* $months=Loanschedule::get()->groupBy(function($d){

           return  Carbon::parse($d->duedate)->format('F');

         });*/

          //$months=\DB::select(\DB::raw("SELECT `month` as monthnumber FROM `loanschedules` GROUP BY `month`"));

     	 return view('reports.loans_month',compact('months','years'));


     }

      public function retrive_loans_month(Request $request){

                  
             $this->validate(request(),[
                'month'=>'required'
             ]);

             

              $monthyear=explode('/',$request->month);

                $month=substr($monthyear[0],1);
                $year=$monthyear[1];

           $loanschedule=Loanschedule::whereMonth('duedate','=',$month)
                                       ->whereYear('duedate','=',$year)->get();


            $code=Code::where('name','=','loan')->first()->code_number;

              //dd($loanschedule);

     	 return view('reports.retrive_loans_month',compact('loanschedule','month','code'));
     }

       public function loans_time_range(){



                 return view('reports.loans_time_range');
       }

       public function retrive_loans_time_range(Request $request){
                             

                    $this->validate(request(),[
                          'startDate'=>'required',
                          'endDate'=>'required'
                    ]);

                      $startDate=$request->startDate;
                      $endDate=$request->endDate;

                     $code=Code::where('name','=','loan')->first()->code_number;

                    $loans=Loan::whereBetween('loanInssue_date',[$request->startDate,$request->endDate])->get();

                       //dd($loan);
             return view('reports.retrive_loans_time_range',compact('loans','code','startDate','endDate'));
       }


       public function expected_profit(){

           // $month=$

             
          return view('reports.expected_profitMonth_interval');
       }


       public function retrive_expected_profit(Request $request){

            $this->validate(request(),[
                          'startDate'=>'required',
                          'endDate'=>'required'
                    ]);

                      $startDate=$request->startDate;
                      $endDate=$request->endDate;

                           

                      /*$loans=Loan::select( 'id','loanInssue_date','mounthlyrepayment_principle','mounthlyrepayment_interest',DB::raw('MONTH(loanInssue_date) as monthnuber'))
                  
                                 ->whereBetween('loanInssue_date',[$request->startDate,$request->endDate])
                                  ->where('loan_status','=','approved')
                                  ->groupBy(DB::raw('MONTH(loanInssue_date)'))
                                 ->get();*/

                 
                    $loans=\DB::select(\DB::raw("SELECT `month` as monthnumber, SUM(monthprinciple) as principlesum, SUM(monthinterest) as interestsum, COUNT(`loans`.id) as no_loans FROM `loanschedules` INNER JOIN `loans` ON `loans`.`id`=`loanschedules`.`loan_id` WHERE `loan_status`='approved' and duedate >='$startDate' and duedate <='$endDate' GROUP BY `month`"));

                    // dd($loans);

           return view('reports.retrive_expected_profit',compact('startDate','endDate','loans'));
       }
}


