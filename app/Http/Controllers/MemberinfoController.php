<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Code;
use App\Insurance;
use App\Loaninsuarance;
use App\Loan;

class MemberinfoController extends Controller
{
    //



  public function __construct(){

  	 return $this->middleware('auth:member');
  }
    public function dashboard($id){

     return view('member.dashboard');
    }  


    public function savings($id){

    	 $member=Member::find($id);

    	 return view('member.info.savings',compact('member'));
    }


     public function shares($id){

    	 $member=Member::find($id);

    	 return view('member.info.shares',compact('member'));
    }

    	 
    public function collaterals($id){

          $member=Member::find($id);

    	 return view('member.info.collaterals',compact('member'));	
    }

    public function loans($id){
      
        $memberloans=Member::find($id)->loanlist->where('loan_status','=','paid');
        $code=Code::where('name','=','loan')->first()->code_number;

    	return view('member.info.loans',compact('memberloans','code','id'));	

    }

    public function loan_info($id,$lid){

      

       $loan=Loan::find($lid);

            $loancollaterals=Loan::find($lid)->collaterals;
               
               $loanguarantors=Loan::find($lid)->guarantor;

               $insurance=Insurance::first();

               $loanfees=Loan::find($lid)->loan_fees;
         

          $code=Code::where('name','=','loan')->first()->code_number;


          return view('member.info.loan_info',compact('loan','code','lid','id','loancollaterals','loanguarantors','insurance','loanfees'));
  
    }
}
