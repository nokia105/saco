<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shares;
use App\User;
use Auth;
use App\Loan;
use App\Insurance;
use App\Loanschedule;
use App\Code;
use App\Member_share;
use App\Membersaving;
use App\Loanpayment;
use PDF;
use App\Glaccount;
use App\Voucher;
use App\Mainaccount;
use App\Memberaccount;
use App\Journalentry;
use App\Payment;
use App\Bankaccount;
use App\Receivableaccount;
use App\LoanCategory;
use App\Member;
use App\Feescategory;
use App\Loanaccount;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     function __construct(){

       return $this->middleware('auth:member');
     }

      public function drafted_loans(){

       $code=Code::where('name','=','loan')->first()->code_number;

       $draftedloans=Loan::orderBy('loanInssue_date')->where('loan_status','=','draft')->get();

           return view('loans.drafted_loans',compact('code','draftedloans'));
      }
     
    public function newloans_received()
    {
        //
       $code=Code::where('name','=','loan')->first()->code_number;

       $receivedloans=Loan::orderBy('loanInssue_date')->where('loan_status','=','submitted')->get();

           

    return view('loans.newloans_received',compact('receivedloans','code'));

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response


     */
}

     public function loan_info($id){

         
          $code=Code::where('name','=','loan')->first()->code_number;

            $loan=Loan::find($id);

            $loancollaterals=Loan::find($id)->collaterals;
               
               $loanguarantors=Loan::find($id)->guarantor;

               $insurance=Insurance::first();

               $loanfees=Loan::find($id)->loan_fees;
         

            return view('loans.received.loan_info',compact('code','loan','loancollaterals','loanguarantors','insurance','loanfees'));
     }


    public function create(Request $request,$id)
    {
        
                     
        
 }


  public function submit($id){

 $code=Code::where('name','=','loan')->first()->code_number;
  $loan=Loan::find($id);

    return view('modal.draft',compact('loan','code'));
  }

   public function agree($id){

         $code=Code::where('name','=','loan')->first()->code_number;
         $loan=Loan::find($id);

        return view('modal.agree',compact('loanprinciple','loanduratuion','loan','code'));

   }


    public function draft_submitted(Request $request){

        /*$this->validate(request(),[

                          'submit_workingdate'=>'required'
               ]);*/
                     $loan=Loan::find($request->loan_id);


                     $loan->loanInssue_date=date('Y-m-d');
                     $loan->inssued_by=Auth::guard('member')->user()->id;
                     $loan->loan_status='submitted';
                    
                     $loan->save();  

                      return redirect()->route('drafted_loans')->with('status','Successfully  submitted'); 
   
    }

   public function agree_submitted(Request $request){

                       /*$this->validate(request(),[

                          'agree_workingdate'=>'required'

                       ]);*/

                      
   
                     $loan=Loan::find($request->loan_id);

                     $user=Auth::guard('member')->user();

                      if($user->hasRole('Accountant|Cashier')){
                         //change boared status----->
                     $loan->board_status='reviewed';
                     $loan->loan_status='reviewed';
                     $loan->board_date=date('Y-m-d');
                     $loan->board_reason=$request->reason;
                     $loan->board_person=$user->member_id;
                     $loan->save();

                        return back()->with('status','Successfully Reviewed');   

                   }elseif($user->hasRole('Loan Officer')){
                                   //original review
                       $loan->firstprocessed_status='assessed';
                     $loan->loan_status='assessed';
                     $loan->firstprocessed_date=date('Y-m-d');
                     $loan->firstprocessed_reason=$request->reason;
                     $loan->firstprocessed_person=$user->member_id;
                     $loan->save();

                         return back()->with('status','Successfully Assessed');
                   }elseif($user->hasRole('Chair')){
                     $loan->chair_status='approved';
                     $loan->loan_status='approved';
                     $loan->chair_date=date('Y-m-d');
                     $loan->chair_person=$user->member_id;
                     $loan->save();
                       //loan schedule was here
                     
                      return back()->with('status','Successfully Approved');


                   }
       
                           

   }


      public function voucher_submitted(Request $request){


                  // dd($request->all());
                        
               $this->validate($request,[
                   
                  'narration'=>'required',
                  'payment_method'=>'required'
               ]);

               $voucher=Voucher::create([
                 'amount'=>$request->amount,
                 'loan_id'=>$request->loan_id,
                 'narration'=>$request->narration,
                 'memberaccount_id'=>$request->memberaccount,
                 'mainaccount_id'=>$request->main_account,
                 'status'=>'pending',
                 'mode_payment'=>$request->payment_method,
                 'date'=>date('Y-m-d'),
                 'created_by'=>Auth::guard('member')->user()->member_id,
                 'voucher_no'=>$request->loan_id+200,
                 'check_no'=>$request->check_no
               ]);

                $loan=Loan::find($request->loan_id);
                $loan->loan_status='pending voucher';
                $loan->save();

                return back()->with('status','Voucher successfully created');

          }
                       //function name to be changed to pending_vouchers
          public function unpaid_vouchers(){
            $code=Code::where('name','=','loan')->first()->code_number;
            $vouchers=Voucher::where('status','=','pending')->get();           
            return view('loans.unpaid_vouchers',compact('vouchers','code'));

          }

       public function reject($id){
         $code=Code::where('name','=','loan')->first()->code_number;
          $loan=Loan::find($id);
      return view('modal.reject',compact('loan','code')); 


   }

      public function reject_submitted(Request $request){

                       $user=Auth::guard('member')->user();

                     $this->validate(request(),[
                         'deny_reason'=>'required',
                       ]);
                      
                      $loan=Loan::find($request->loan_id);
                      if($user->hasRole('Loan Officer')){
                     
                     
                     $loan->loan_status='rejected';
                      $loan->board_status='denied';
                     $loan->board_reason=$request->deny_reason;
                     $loan->board_date=date('Y-m-d');
                     $loan->board_person=Auth::guard('member')->user()->member_id;         
                     $loan->save(); 

                     return back()->with('status',' Successfully Denied'); 

                   }elseif($user->hasRole('Accountant')){

                    $loan->loan_status='rejected';
                    $loan->accountant_status='rejected';
                     $loan->accountant_reason=$request->deny_reason;
                     $loan->accountant_date=date('Y-m-d');
                     $loan->accountant_person=Auth::guard('member')->user()->member_id;         
                     $loan->save(); 
                     return back()->with('status',' Successfully Denied'); 
                   }else{

                     $loan->loan_status='rejected';
                     $loan->chair_status='rejected';
                     $loan->chair_reason=$request->deny_reason;
                     $loan->chair_date=date('Y-m-d');
                     $loan->board_person=Auth::guard('member')->user()->member_id;         
                     $loan->save(); 
                     return back()->with('status',' Successfully Denied'); 

                   }


      }



        public function pending($id){
          $code=Code::where('name','=','loan')->first()->code_number;
          $loan=Loan::find($id);
      return view('modal.pending',compact('loan','code')); 


   }


      public function pending_submitted(Request $request){

                  $this->validate(request(),[
                         'pending_reason'=>'required'

                         /* 'pending_workingdate'=>'required'*/

                       ]); 

                      $loan=Loan::find($request->loan_id);


                     $loan->loan_status='pending';
                     $loan->board_status='pending';
                     $loan->board_reason=$request->pending_reason;
                     $loan->board_date=date('Y-m-d');
                   /*  $loan->_workingdate=$request->pending_workingdate;*/
                     $loan->board_person=Auth::guard('member')->user()->member_id;
                   
                     $loan->save(); 

                     return back()->with('status','Waiting'); 
      }

 

    public function approved_loans()
    {

     $code=Code::where('name','=','loan')->first()->code_number;
    $approved_loans=Loan::orderBy('loanInssue_date')->where('loan_status','=','approved')->get();

    return view('loans.approved_loans',compact('approved_loans','code'));

    }



    public function rejected_loans()
    {
     $code=Code::where('name','=','loan')->first()->code_number;
       $rejected_loans=Loan::orderBy('loanInssue_date')->where('loan_status','=','rejected')->get();

    return view('loans.rejected_loans',compact('rejected_loans','code'));


    }
    public function appended_loans()
    {
        $code=Code::where('name','=','loan')->first()->code_number;
        $appended_loans=Loan::orderBy('loanInssue_date')->where('loan_status','=','pending')->get();

    return view('loans.pending_loans',compact('appended_loans','code'));
 
    }


      public function processed_loans(){

       $code=Code::where('name','=','loan')->first()->code_number;
        $processed_loans=Loan::orderBy('loanInssue_date')
        ->where('loan_status','=','reviewed')
        ->orwhere('loan_status','=','assessed')
        ->get();
         return view('loans.processed_loans.index',compact('processed_loans','code'));
      }

          public function voucher($id){
            $code=Code::where('name','=','loan')->first()->code_number;
            $sacoss_loanaccount=Mainaccount::where('name','=','Loan Account')->first();
            $loan=Loan::find($id);



             return view('modal.voucher',compact('loan','code','sacoss_loanaccount'));  

          }

            public function approve_voucher($id){

          // $code=Code::where('name','=','loan')->first()->code_number;
            $loan=Loan::find($id);
            $sacoss_loanaccount=Mainaccount::where('name','=','Loan Account')->first();

           return view('modal.approve_voucher',compact('loan','code','sacoss_loanaccount'));
      }

        public function ready_vouchers(){

          $vouchers=Voucher::where('status','approved')->get();
           $code=Code::where('name','=','loan')->first()->code_number;

           return view('loans.ready_vouchers',compact('vouchers','code'));
        }

          
      public function paid($id){

          // $code=Code::where('name','=','loan')->first()->code_number;
            $loan=Loan::find($id);

           return view('modal.paid',compact('loan','code'));
      }



        public function approve_voucher_submitted(Request $request){
                        
                                  //update voucher number

                          $loan=Loan::find($request->loan_id);

                            $loan->loan_status='approved voucher';
                            $loan->save();

                            $voucher=Voucher::find($request->voucher_id);
                            $voucher->approved_date=date('Y-m-d');
                              //chair
                            $voucher->approved_by=Auth::guard('member')->user()->member_id;
                            $voucher->status='approved';
                           
                            $voucher->save();
                            
                             return back()->with('status','Sucessfully Approved');

        }


       public function paid_submitted(Request $request){
                      
                      $loan=Loan::find($request->loan_id);
                      
                            //dd($loan->loan_fees()->sum('fee_value'));

                      $member_interestaccount=$loan->member->memberaccount->where('name','=','Interest Account')->first();
                      $main_interestaccount=Mainaccount::where('name','=','Interest Account')->first();
                      $main_chargesaccount=Mainaccount::where('name','=','Charges Account')->first();
                      $member_chargesaccount=Memberaccount::where('name','=','Charges Account')->first();
                      $main_insuranceaccount=Mainaccount::where('name','=','Insurance Account')->first();
                      $member_insuranceaccount=Memberaccount::where('name','=','Insurance Account')->first();

                      $bankaccount=Mainaccount::where('name','=','Bank Account')->first();
                     /*  do {
                  $digits =4;
                  $second_num = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
                  $order_gen = "10".$second_num;
                  }while (record_exists($order_gen);
                        
                      dd($order_gen);

                      //update voucher status



*/       
                                        
                            $payment=Payment::create([
                           'loan_id'=>$request->loan_id,
                            'amount'=>$request->amount_paid,
                            'narration'=>$loan->voucher->narration,
                            'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                            'payment_type'=>strtolower($request->mode_payment),
                            'state'=>'out',
                            'date'=>date('Y-m-d')        
                         ]);



                                //cr bank account principle 

                                Bankaccount::create([
                                  'memberaccount_id'=>$request->memberaccount,
                                  'mainaccount_id'=>$request->mainaccount,
                                  'cr'=>$request->amount_paid,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                ]);


                                   //loan account principle
                                    Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount,
                                       'mainaccount_id'=>$request->mainaccount,
                                       'cr'=>$request->amount_paid,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]);

                                       //bank charges

                                Bankaccount::create([
                                  'memberaccount_id'=>$member_chargesaccount->id,
                                  'mainaccount_id'=>$main_chargesaccount->id,
                                  'dr'=>$loan->loan_fees()->sum('fee_value'),
                                  'description'=>'charges',
                                  'date'=>date('Y-m-d')
                                ]);
                                    //dr Recivable account principle

                                   Receivableaccount::create([
                                     'dr'=>$request->amount_paid,
                                     'memberaccount_id'=>$request->memberaccount,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);

                                       //dr Recivable account charges

                                       Receivableaccount::create([
                                      'cr'=>$loan->loan_fees()->sum('fee_value'),
                                      'memberaccount_id'=>$request->memberaccount,
                                      'description'=>'charges',
                                      'date'=>date('Y-m-d')

                                   ]);
 

                               // be discussed


                            //create  principle journal entry member 

                             Journalentry::create(
                              [       
                               'dr'=>$request->amount_paid, 
                                 'memberaccount_id'=>$request->memberaccount,
                                  'payment_id'=>$payment->id,
                                    'date'=>date('Y-m-d'),
                                'service_type'=>'loan']
                                   
                             ); 

                                //loan principle journal main 

                             Journalentry::create([
                                  'cr'=>$request->amount_paid, 
                                 'mainaccount_id'=>$bankaccount->id,
                                  'payment_id'=>$payment->id,
                                  'date'=>date('Y-m-d'),
                                 'service_type'=>'loan']); 

                              

                                    //charges dr
                                     Journalentry::create([
                                  'dr'=>$loan->loan_fees()->sum('fee_value'), 
                                 'mainaccount_id'=>$bankaccount->id,//$main_chargesaccount->id,
                                  'payment_id'=>$payment->id,
                                  'date'=>date('Y-m-d'),
                                 'service_type'=>'charges']); 


                                    //charges ,cr   
                                       Journalentry::create([
                                  'cr'=>$loan->loan_fees()->sum('fee_value'), 
                                 'memberaccount_id'=>$member_chargesaccount->id,
                                  'payment_id'=>$payment->id,
                                  'date'=>date('Y-m-d'),
                                 'service_type'=>'charges']); 
     

                                    //insurance dr member
                                      Journalentry::create([
                                  'dr'=>$loan->insurances->percentage_insurance, 
                                 'memberaccount_id'=>$member_insuranceaccount->id,
                                  'payment_id'=>$payment->id,
                                  'date'=>date('Y-m-d'),
                                 'service_type'=>'insurance']); 

                                    //insurance cr member       

                                       Journalentry::create([
                                  'cr'=>$loan->insurances->percentage_insurance, 
                                 'mainaccount_id'=>$bankaccount->id,
                                  'payment_id'=>$payment->id,
                                  'date'=>date('Y-m-d'),
                                 'service_type'=>'insurance']); 


                          for($i=0; $i<$loan->duration; $i++){

                            $duedate=date('Y-m-d', strtotime($i.' month', strtotime(date('Y-m-d'))));
                                Loanschedule::create([
                                               
                                'loan_id'=>$loan->id,                   
                                 'monthprinciple'=>$loan->mounthlyrepayment_principle, //loan schedule
                                 'monthinterest'=>$loan->mounthlyrepayment_interest,
                                 'duedate'=>$duedate,
                                 'month'=>date('m',strtotime($duedate))

                           ]);

                           }


                         $voucher=Voucher::find($request->voucher_id);
                         $voucher->status='paid';
                         $voucher->paid_date=date('Y-m-d');
                         $voucher->paid_by=Auth::guard('member')->user()->member_id;
                         $voucher->save();
                              
                               //update loan status
                         $loan->loan_status='paid'; 
                         $loan->save();

                       

                    // return view('loans.receipt.paidloans_slip',compact('loan')); 

                         return back()->with('status','Sucessfully paid');
       }

        public function paidloans_slip($id){

               $loan=Loan::find($id);     
            $pdf = PDF::loadView('loans.receipt.paidloans_slip',compact('loan'));
            return $pdf->download('paid.pdf');
       }


        public function paid_loans(){

                 $code=Code::where('name','=','loan')->first()->code_number;
        $paid_loans=Loan::orderBy('loanInssue_date')
        ->where('loan_status','=','paid')->get();
       
           return view('loans.paid_loans',compact('paid_loans','code'));
        }


         public function printcheck(Request $request){
        $array=explode(',', $request->array);
         $vouchers=Voucher::find($array);

                foreach($vouchers as $voucher){
    echo '<tr>
      
    <td>'.$voucher->loan->member->first_name.'</td>
    <td>'.$voucher->updated_date.'</td>
    <td>'.$voucher->check_no.'</td>
    <td>'.$voucher->amount.'</td>
    <td>'.$voucher->amount.'</td>
    </tr>';
     
}

                 
         }



         public function printdispatch(Request $request){

          $array=explode(',', $request->array);
         $vouchers=Voucher::find($array);

                foreach($vouchers as $voucher){
    echo '<tr>
      
    <td>'.$voucher->loan->member->first_name.'</td>
    <td>'.$voucher->updated_date.'</td>
    <td>'.$voucher->check_no.'</td>
    <td>'.$voucher->amount.'</td>
    <td>'.$voucher->amount.'</td>
    </tr>';
     
} 
   }


    public function editloan($id){
           // $loan_id=request()->segment(4);


            $member_id=Loan::find($id)->member->member_id;
           // $username=Auth::user()->name;
            $member=Member::find($member_id);

                    if(count($member->collateral)){
            $collaterals=Member::find($id)->collateral; 
             
               }     
            $loancategories=LoanCategory::select('id','category_name')->get();
            $guarantors=Member::all()->where('member_id','!=',$member_id);
            $fees=Feescategory::all();
            $loan=Loan::find($id);
           
            return view('loans.editloan',compact('loancategories','username','member','collaterals','guarantors','fees','loan','member_id'));
          }


    public function edit($id)
    {
        //
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response



     */ }
    public function update(Request $request, $id)
    {
             //dd($request->all());

          $loanperiod=$request->period;
           $principle=$request->principle;
            $interest=$request->interest;
           $member_id=$request->memberloan;
           // $loan_id=$request->loanid; 
            $collate_id=$request->collate;
            $guarator_id=$request->guarantor;
            $charges=$request->charges;
           $loan=Loan::find($id);
           $insurance=Insurance::first()->percentage_insurance;

                  if($request->has('collate')){
                      
                  $totalcollateral_value=Collateral::find($collate_id)->sum('colateral_value');

                   if($principle<=80/100*$totalcollateral_value){

                  
            Loan::find($id)
            ->update([
                  'loancategory_id'=>$request->pcategory,
                  'duration'=>$loanperiod,
                  'interest'=>$request->interest,
                  'principle'=>$request->principle,
                  'repayment_date'=>$request->startpayment,
                  'no_of_installments'=>$loanperiod,
                  'mounthlyrepayment_amount'=>($principle/$loanperiod)+(($interest/100)*$principle)/$loanperiod,
                  'mounthlyrepayment_principle'=>$principle/$loanperiod,
                 'mounthlyrepayment_interest'=>(($interest/100)*$principle)/$loanperiod,
                 'inssued_by'=>Auth::guard('member')->user()->member_id,
                  'loan_status'=>'submitted' //to be deleted
               ]);
                Loaninsuarance::create([
                     'loan_id'=>$id,
                     'insuarance_pacentage'=>234.678
                 ]);        
              $loan->collaterals()->sync($collate_id);
              $loan->guarantor()->sync( $guarator_id);
              $loan->loan_fees()->sync($charges);


          
                     return back()->with('status','your loan is accepted');   

                      

                   }

                    return back()->with('error','your loan must be 80% of your collaterals')->withInput();


                   }else{

                     $totalsaving=Member::find($loan->member->member_id)->savingamount->sum('amount');

                if($principle<=3*$totalsaving){
            Loan::find($id)
            ->update([
                  'loancategory_id'=>$request->pcategory,
                  'duration'=>$loanperiod,
                  'interest'=>$request->interest,
                  'principle'=>$principle,
                  'repayment_date'=>$request->startpayment,
                  'no_of_installments'=>$loanperiod,
                  'mounthlyrepayment_amount'=>($principle/$loanperiod)+(($interest/100)*$principle)/$loanperiod,
                  'mounthlyrepayment_principle'=>$principle/$loanperiod,
                 'mounthlyrepayment_interest'=>(($interest/100)*$principle)/$loanperiod,
                 'inssued_by'=>Auth::guard('member')->user()->member_id,
                 'loan_status'=>'submitted'
               ]);

              $loan->guarantor()->sync($guarator_id);
              $loan->loan_fees()->sync($charges);



                

            
  return redirect()->route('loanlist',['id'=>$loan->member->member_id]); 

  }
   return back()->with('error','You asked for a loan which is more than your savings'); 
 }
    
          
     }    

        public function delete($id){

            $loan=Loan::find($id);

            
               //not deleting the loan associates

             $loan->delete();
             //$loan->guarantor()->delete();
             $loan->loan_fees()->detach();

            


              return back()->with('status','Successfully Deleted');
        }

    public function destroy($id)
    {
        //
    }
}
