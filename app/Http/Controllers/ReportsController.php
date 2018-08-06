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
use App\Journalentry;
use App\Bankaccount;
use App\Expense;
use App\Tax;

class ReportsController extends Controller
{
    //

     
     function __construct(){

       return $this->middleware('auth:member');
     }

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

       public function income_statments(){

        return view('reports.finacial.income_statments');
       }

       public function duration_incomestatment(Request $request){

                         

                      $year=$request->year;
                      $period=explode('-', $request->period);
                      $startmonth=$period[0];
                      $endmonth=$period[1];

                 


                   $otherincomes=DB::table('bankaccounts')
                    ->join('mainaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                      ->where('categoryaccountstypes.name','=','Other Income')
                    ->whereRaw("month(bankaccounts.date) between $startmonth and $endmonth")
                    ->groupBy('mainaccount_id')
                    ->whereRaw(" year(bankaccounts.date)",$year)
                    ->get();
                 
                   
                   $operatinalexpenses=DB::table('expenses')->join('mainaccounts','expenses.mainaccount_id','=','mainaccounts.id')

                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                    ->where('categoryaccountstypes.name','=','Operatinal Expenses')
                    ->whereRaw("month(expenses.date) between $startmonth and $endmonth")
                     ->whereRaw(" year(expenses.date)",$year)
                    ->groupBy('mainaccount_id')
                    ->get();

                       // dd($operatinalexpenses);

                    $busnessexpenses=DB::table('expenses')->join('mainaccounts','expenses.mainaccount_id','=','mainaccounts.id')

                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                    ->where('categoryaccountstypes.name','=','Busness Expenses')
                    ->whereRaw("month(expenses.date) between $startmonth and $endmonth")
                     ->whereRaw(" year(expenses.date)",$year)
                    ->groupBy('mainaccount_id')
                    ->get();


                    $otherexpenses=DB::table('expenses')->join('mainaccounts','expenses.mainaccount_id','=','mainaccounts.id')

                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(expenses.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                    ->where('categoryaccountstypes.name','=','Other Expenses')
                    ->whereRaw("month(expenses.date) between $startmonth and $endmonth")
                     ->whereRaw(" year(expenses.date)",$year)
                    ->groupBy('mainaccount_id')
                    ->get();


                       
                    $loanncomes=DB::table('bankaccounts')
                    ->join('mainaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('SUM(bankaccounts.dr) as dramount'),DB::raw('mainaccounts.name as mainnames'))
                      ->where('categoryaccountstypes.name','=','Loan Interest')
                    ->whereRaw("month(bankaccounts.date) between $startmonth and $endmonth")
                     ->whereRaw(" year(bankaccounts.date)",$year)
                    ->groupBy('mainaccount_id')
                    ->get();


                  $taxpecentage=Tax::where('year','=',$year)->sum('percentage');

                 


                return view('reports.finacial.duration_incomestatment',compact('endmonth','startmonth','otherincomes','loanncomes','operatinalexpenses','busnessexpenses','otherexpenses','year','taxpecentage','startmonth','endmonth'));
       }


        public function balance_sheets(){



            return view('reports.finacial.balance_sheets');
        }


         public function findbalance_sheets(Request $request){

                     //Asset=Liability+Equity

             $year=$request->year;

          
         $currentassets=DB::table('bankaccounts')
                    ->join('mainaccounts','bankaccounts.mainaccount_id','=','mainaccounts.id')
                    ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                    ->select(DB::raw('(SUM(bankaccounts.dr)-SUM(bankaccounts.cr)) as accountsum'),DB::raw('mainaccounts.name as mainnames'))
                      ->where('categoryaccountstypes.name','=','Current Asset')
                      ->whereYear('bankaccounts.date',$year)
                      ->where('mainaccount_id','!=',6)
                    ->groupBy('mainaccount_id')
                    ->get();

                      

            $cashaccounts=DB::table('journalentries')
                                  ->join('mainaccounts','journalentries.mainaccount_id','=','mainaccounts.id')
                                  ->join('categoryaccountstypes','categoryaccountstypes.id','=','mainaccounts.categoryaccountstype_id')
                                  ->select(DB::raw('(SUM(journalentries.dr)-SUM(journalentries.cr)) as accountsum'),DB::raw('mainaccounts.name as mainnames'))
                                   ->whereYear('journalentries.date',$year)
                      ->where('mainaccount_id','=',6)
                    ->groupBy('mainaccount_id')
                    ->get();

  
             return view('reports.finacial.findbalance_sheets',compact('currentassets','cashaccounts'));
         }
}


