<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoanCategory;
use Auth;
use App\Member;
use App\Collateral;
use App\Loan;
use App\Loaninsuarance;
use Illuminate\Support\Facades\DB;
use App\Feescategory;
use App\Member_share;
use App\Share;
use App\Interestmethod;
use Carbon\Carbon;
use PDF;
use App\Loanschedule;
use App\Repayment;
use App\Membersaving;
use App\Insurance;
use App\Code;
use App\Mainaccount;
use App\Penalty;
use App\Payment;
use App\Journalentry;
use App\Payableaccount;
use App\Bankaccount;
use App\Loanaccount;
use App\Receivableaccount;
class MembersProfileController extends Controller
{
    // 

     function __construct(){

       return $this->middleware('auth:member');
     }


  public function cover($mprofileid){

    
    return view('loans.profile');
  }

     
     // }


      public function newloan($id){

               
            

                

            $username=Auth::guard('member')->user();

            $member=Member::find($id);
         
            $collaterals=Member::find($id)->collateral;      
              
            $loancategories=LoanCategory::select('id','category_name')->get();

            $guarantors=Member::all()->where('member_id','!=',$id);
            $fees=Feescategory::all()->where('fee_name','!=','Registration fee');
            $interestmethods=Interestmethod::all();
            return view('loans.newloan',compact('loancategories','username','member','collaterals','guarantors','fees','interestmethods'));
          }


      public function interest(Request $request){

         	 $pcategory_id=$request->pcategory;

              $interest=LoanCategory::select('id','default_duration','interest_rate')->find($pcategory_id);
                 echo json_encode([
                   'id'=>$interest->id,
                   'interest'=>$interest->interest_rate,
                   'duration'=>$interest->default_duration
                 ]);      
         }



      public function interestmethod(Request $request){
            // $principle=$request->principle;
             $period=$request->period;
             $startpayment=$request->startpayment;
             $Imethod=$request->Imethod;

            
               echo json_encode([
                
                 'principle'=>$request->principle,
                 'interest'=>$request->interest,
                 'monthlyrepayment'=>round(($request->principle/$period)+(($request->interest/100)*$request->principle)/$period,2),
                 'loanperiod'=>$request->period,
                 'firstpayment'=>$request->startpayment,
                 'lastpayment'=>date('Y-m-d', strtotime($request->period.' month', strtotime($request->startpayment))),
                 'loanrequestor'=>$request->loanrequestor,
                 'loanOfficer'=>$request->loanOfficer



               ]);
                  

      }
      public function membercollateral(Request $request){
                   $collateral_id=$request->collateral;             
          //$collaterals=Member::find($id)->collateral->where('id','=',1); 
              $collateral=Collateral::find($collateral_id);    
            echo json_encode([
                   'id'=>$collateral->id,
                   'asset'=>$collateral->colateral_name,
                   'value'=>$collateral->colateral_value,
                   'duration'=>$collateral->colateralevalution_date
                 ]);       
         }

      public function guarantors(Request $request){
             
           $guarator_id=$request->g;

            $guarator=Member::find($guarator_id);
            echo json_encode([
              'id'=>$guarator->member_id,
              'firstname'=>$guarator->first_name,
              'middlename'=>$guarator->middle_name,
              'lastname'=>$guarator->last_name

            ]);     
         }

      public function loancharges(Request $request){  
          $charge_id=$request->charge_id;
          $charge=DB::table('feescategories')
                     ->select('id','fee_value','fee_name')
                     ->where('id', $charge_id)
                     ->get();
                foreach ($charge as $key) {
                        $data=array('id'=>$key->id,
                    'fee_name'=>$key->fee_name,
                    'fee_value'=>$key->fee_value );
                   }
            echo json_encode($data);     
         }

      public function createloan(Request $request){


            $member_id=$request->memberloan;
            $pcategory_id=$request->pcategory;
            $loanOfficer_id=$request->loanOfficer;
            $principle=$request->principle;
            $interest=$request->interest;
            $Imethod=$request->Imethod;
            $loanperiod=$request->period;
            $loanwm=$request->loanwm;
            $startpayment=$request->startpayment;
             //colateral from js field  
            $collate_id=$request->collate;
            $guarator_id=$request->guarantor;
            $charges=$request->charges;

                  /*dd(Member::check_registered_days($member_id));*/

                  //we get priciple deducting charges and insuarances
                    
                $validator=$this->validate(request(),[
                 'pcategory'=>'required',
                 'principle'=>'required|numeric',
                 'interest'=>'required|numeric',
                 'Imethod'=>'required',
                 'period'=>'required|numeric',
                 'startpayment'=>'required|date'

                ]);

             //$mInterest=($interest/100)*$principle;

                    $no_shares=Member::find($member_id)->no_shares->sum('No_shares');
                
                    $max_shares=Share::select('max_shares')->first()->max_shares; 

                    $totalsaving=Member::find($member_id)->savingamount->sum('amount');

                    $differ_register_days=Member::find($member_id)->joining_date->diffInDays(Carbon::now());
                     
                    $insurance=Insurance::first()->percentage_insurance; //since we had only one insurance
                       
                   // $newprinciple= $principle-$request->principle*$insurance/100;

                        //dd($newprinciple);
                          
                           

                     if($differ_register_days>=90){

                               //testing purpose <=
                         if($no_shares==$max_shares){

                   if($request->has('collate')){
                      
                  $totalcollateral_value=Collateral::find($collate_id)->sum('colateral_value');

                   if(/*$principle<=(80/100*$totalcollateral_value+$totalsaving ) ||*/ $principle<=80/100*$totalcollateral_value ){
                            
                             $loan=Loan::create([
                            'loanInssue_date'=>date('Y-m-d'),
                            'inssued_by'=>Auth::guard('member')->user()->member_id,

                            'loan_status'=>($request->submit=='draft') ? 'draft' :'submitted',
                            'loancategory_id'=>$pcategory_id,
                            'member_id'=>$member_id,
                            'duration'=>$loanperiod,
                            'interestmethod_id'=> $Imethod,
                            'interest'=>$interest,
                            'principle'=>$principle,
                            'repayment_date'=>$startpayment,
                            'no_of_installments'=>$loanperiod,
                            'mounthlyrepayment_amount'=>($principle/$loanperiod)+(($interest/100)*$principle)/$loanperiod,//total monthly pricinple+m.niterest+other changes 1month
                            'mounthlyrepayment_principle'=>$principle/$loanperiod, 
                           'mounthlyrepayment_interest'=>(($interest/100)*$principle)/$loanperiod,
                          
                           'insurance_id'=>Insurance::first()->id
               ]);


                                    $loan->collaterals()->attach($collate_id);
                                    $loan->guarantor()->attach( $guarator_id);
                                    $loan->loan_fees()->attach($charges);

                        

                                             return back()->with('status','your loan is accepted');         

                   }

                                            return back()->with('error','your loan must be 80%  or of your collaterals')->withInput();


                   }else{
                  
                    // $totalsaving=Member::find($member_id)->savingamount->sum('amount');

                    if($principle<=3*$totalsaving){

                $loan=Loan::create([

                            'loanInssue_date'=>date('Y-m-d'),
                            'inssued_by'=>Auth::guard('member')->user()->member_id,
                            'loan_status'=>($request->submit=='draft') ? 'draft' :'submitted',
                            'loancategory_id'=>$pcategory_id,
                            'member_id'=>$member_id,
                            'duration'=>$loanperiod,
                            'interestmethod_id'=> $Imethod,
                            'interest'=>$interest,
                            'principle'=>$principle,
                            'repayment_date'=>$startpayment,
                            'no_of_installments'=>$loanperiod,
                            'mounthlyrepayment_amount'=>($principle/$loanperiod)+(($interest/100)*$principle)/$loanperiod,//total monthly pricinple+m.niterest+other changes 1month
                            'mounthlyrepayment_principle'=>$principle/$loanperiod, 
                           'mounthlyrepayment_interest'=>(($interest/100)*$principle)/$loanperiod,
                         
                           'insurance_id'=>Insurance::first()->id


               ]);
                         
             
              $loan->guarantor()->attach($guarator_id);
              $loan->loan_fees()->attach($charges);



                                     return back()->with('status','your loan is accepted');

              }  
                  

                                     return back()->with('error','You asked for a loan which is more than your savings')->withInput();     

                   }

                   
                 }else{

                                     return back()->with('error','you must have 1000 shares in your account')->withInput();

                    }


                     }else{


                                      return back()->with('error','you must be a member for three months')->withInput();
                     }
               
      }

   public function loanlist($id)
      {
      
        $code=Code::where('name','=','loan')->first()->code_number;

       $loanlists=Member::find($id)->loanlist->where('loan_status','=','paid'); //approved
            
           
        

        //dd($loanlist->interrepayment->sum('amountpayed'));
      return view('loans.loanlist' , compact('loanlists','id','code')); 
    }

  
public function updateloan(Request $request)
 
 {  

              /*$this->validate(request(),[
                 'pcategory'=>'required',
                 'principle'=>'required|numeric',
                 'interest'=>'required|numeric',
                 'Imethod'=>'required',
                 'loanperiod'=>'required|numeric',
                 'startpayment'=>'required|date'

                ]);*/
          

}
        //download pdf

    public function pdfview(Request $request,$priciple,$interest,$period,$firstpayment){

               $principle=request()->segment(2);
                $interest=request()->segment(3);

                $period=request()->segment(4); 
                $firstpayment=request()->segment(5);

                $monthlyrepayment=round(($principle/$period)+(($interest/100)*$principle)/$period,2);  
                $montlyinterest=(($interest/100)*$principle)/$period;

                $pdf = PDF::loadView('loans.loanrepaymentpdf',compact('principle','interest','period','firstpayment','monthlyrepayment','montlyinterest'));
            return $pdf->download('pdfview.pdf');
    }



      public function schedule(){

           $loan_id=request()->segment(4);
           $member_id=request()->segment(2);

           $loan=Loan::find($loan_id);

            $loancollaterals=Loan::find($loan_id)->collaterals;
               
               $loanguarantors=Loan::find($loan_id)->guarantor;

               $insurance=Insurance::first();

               $loanfees=Loan::find($loan_id)->loan_fees;
         

          $code=Code::where('name','=','loan')->first()->code_number;


           //$code=2000+$loan_id+$id;



           return view('loans.schedule',compact('loan','code','loan_id','member_id','loancollaterals','loanguarantors','insurance','loanfees'));
      }


              //repayment
      public function payment(){

        return view('loans.payment');
      }


        public function ajaxreceivepayment(Request $request,$id){

                     $member=Member::find($id);

                if($request->payment_type=='loan'){

                   
                    $main_account=Mainaccount::where('name','=','Loan Account')->first();

                   echo json_encode([
                    'member_account'=>$member->memberaccount->where('name','=','Loan Account')->first()->account_no .': ' .strtoupper($member->first_name .' '.$member->last_name),
                    'main_account'=>$main_account->account_no . strtoupper(' : Loan'),
                    'memberaccount_id'=>$member->memberaccount->where('name','=','Loan Account')->first()->id,
                    'mainaccount_id'=>$main_account->id

                   ]);
                }elseif($request->payment_type=='share'){
                  $main_account=Mainaccount::where('name','=','Share Account')->first();
                 echo json_encode([
                    'member_account'=>$member->memberaccount->where('name','=','Share Account')->first()->account_no .': ' .strtoupper($member->first_name .' '.$member->last_name),
                    'main_account'=>$main_account->account_no. strtoupper(' : Share'),
                    'memberaccount_id'=>$member->memberaccount->where('name','=','Share Account')->first()->id ,
                    'mainaccount_id'=>$main_account->id

                   ]);
                }elseif($request->payment_type=='saving'){
                    $main_account=Mainaccount::where('name','=','Saving Account')->first();
                 echo json_encode([
                    'member_account'=>$member->memberaccount->where('name','=','Saving Account')->first()->account_no .': ' .strtoupper($member->first_name .' '.$member->last_name),
                    'main_account'=>$main_account->account_no. strtoupper(' : Saving'),
                    'memberaccount_id'=>$member->memberaccount->where('name','=','Saving Account')->first()->id,
                    'mainaccount_id'=>$main_account->id

                   ]);

                }elseif($request->payment_type=='reg_fee'){

                  $main_account=Mainaccount::where('name','=','Registration Fee')->first();

                  echo json_encode([
                    'member_account'=>$member->memberaccount->where('name','=','Registration Fee')->first()->account_no .': ' .strtoupper($member->first_name .' '.$member->last_name),
                    'main_account'=>$main_account->account_no. strtoupper(' : Registration Fee'),
                    'memberaccount_id'=>$member->memberaccount->where('name','=','Registration Fee')->first()->id,
                    'mainaccount_id'=>$main_account->id

                   ]);
                   

                }else{
                 echo json_encode([
                    'member_account'=>"none",
                    'main_account'=>"none"
                     ]);

                }
        }
           //repayment
       public function storepayments(Request $request){

           //dd($request->all());

                           $member=Member::find($request->member);
                            $amountinput=$request->payment;
                             $getpaymenttype=$request->payment_type;

                          

                      $this->validate(request(),[
                            'payment_type'=>'required',
                            'payment'=>'required|numeric'
                      ]);
                  

                  $newamount=0;

                   $bankaccount=Mainaccount::where('name','=','Bank Account')
                                            ->first();

                      
                if($request->payment_type=='loan'){
                    $member_loans=Member::find($request->member)->loanlist->where('loan_status','=','paid');
                      //orderby date
                                  
                           
                       foreach($member_loans as $loan){
                           
                          foreach($loan->loanschedule  as $loan_schedule){


                                          
                                           // dd($loan_schedule);
                                 if($loan_schedule->status!='paid') {
                                                      //get first row in table


                                   $payment=Payment::create([
                                     'loan_id'=>$loan_schedule->loan->id,
                                      'amount'=>$request->payment,
                                      'narration'=>$request->narration,
                                      'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                                      'payment_type'=>$request->payment_method,
                                      'state'=>'in',
                                      'date'=>date('Y-m-d')
                                         ]);

                  $member_interestaccount=$member->memberaccount->where('name','=','Interest Account')->first();
                      $main_interestaccount=Mainaccount::where('name','=','Interest Account')->first();
                       $main_loanaccount=Mainaccount::where('name','=','Loan Account')->first();
                      $month_paid_interest=$loan_schedule->monthrepayment->sum('interestpayed');
                      $month_paid_principle=$loan_schedule->monthrepayment->sum('principlepayed');


                                        if(is_null($loan_schedule->monthpenaty)){
                                                  
                                                    //dd($loan_schedule->monthpenaty);
                                            //amount he  has paid
                                
                                $month_paid_amount=$month_paid_interest+$month_paid_principle;

                               $totalmonthpay=($loan_schedule->monthprinciple+$loan_schedule->monthinterest)-$month_paid_amount;

                    
                                            $interest_to_pay=$loan_schedule->monthinterest-$month_paid_interest;


                                                $principle_to_pay=$loan_schedule->monthprinciple-$month_paid_principle;

                                                         $total_to_pay=($principle_to_pay+$interest_to_pay);
                                                     
                                              


                                                //store in payment table

                                                      
                                                           
                                                          if($amountinput==$totalmonthpay){         
                                                               
                                                             $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                             ]);  

                                                          //$newamount=0;
                                                           
                                                       $repayment->monthrepayment()->attach($loan_schedule->id);
                                                       $loan_schedule->status='paid';
                                                       $loan_schedule->save();

                                                                         
                                                      /*if($loan->loanrepayment->sum('amountpayed')==($loan_schedule->sum('monthprinciple')+$loan_schedule->sum('monthinterest'))){

                                                     $loan->loan_status='inactive';
                                                      $loan->save();*/


                                                //cr loan account in bank
                                           
                                   Bankaccount::create([

                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'dr'=>$principle_to_pay,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$principle_to_pay,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]);

                                          //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //loan  account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$principle_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);

                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]);


                                            
                                                  
                                   
                                                //store in jornal table 


                                                            //principle main
                                                Journalentry::create(
                                               [
                               
                                             'dr'=>$principle_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>$principle_to_pay, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,//$main_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);

                                          return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));
                                                             
                                                        break; 

                                                        

                                               }
                                               else if($amountinput>$totalmonthpay){
                                                     //to br followed
                                                           
                                                           $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                   $newamount=$amountinput-$totalmonthpay;   
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='paid';
                                                                    $loan_schedule->save();

                                                         
                                               
                                     Bankaccount::create([

                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'dr'=>$principle_to_pay,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$principle_to_pay,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]);

                                          //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //loan  account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$principle_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                  ]);

                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]);



 
                                                //store in jornal table 

                                                           
                                                            //principle main
                                                Journalentry::create(
                                               [
                               
                                             'dr'=>$principle_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>$principle_to_pay, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,//$main_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);
                                                                              
                                                              //return back()->with('status','Loan deposited'); 
                                                                               

                                               }
                                               else if($amountinput<$totalmonthpay){


                                                /*  if(($loan_schedule->monthinterest+$loan_schedule->monthprinciple)!=$loan_schedule->monthrepayment->sum('amountpayed')){*/

                                                     if($amountinput<$interest_to_pay){

                                                               
                                                                 $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> 0,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$interest_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='incomplete';
                                                                    $loan_schedule->save();


                             




                                                     //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]);                      

                                                //store in jornal table 
                                     
                                                      //interst main
                                                Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,//$main_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);
     
                                                return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));
                                                             
                                                           break;
                                                              

                                         }else if($amountinput>=$interest_to_pay){
                                                                     
                                                        //start inserting in principle

                                                                   $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=>($amountinput-$interest_to_pay),
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$amountinput,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                 $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                  $loan_schedule->status='incomplete';
                                                                  $loan_schedule->save();





                               Bankaccount::create([

                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'dr'=>($amountinput-$interest_to_pay),
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>($amountinput-$interest_to_pay),
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]);


                                             //receivable account
                                         Receivableaccount::create([
                                     'cr'=>($amountinput-$interest_to_pay),
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);
                                                    
                                                              //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]);  


                                                //store in jornal table 


                                                            //principle main
                                                      Journalentry::create(
                                                  [
                               
                                             'dr'=>($amountinput-$interest_to_pay), 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>($amountinput-$interest_to_pay), 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,//$main_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);
                                                                    

                                                  
                                              return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));
                                                             
                                                              break;


                                                        } 

                                               }



                                                if($newamount>0){


                                                           $amountinput=$newamount;
                                                        } 
                                                else return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));


                                        }else{

                                                // dd($request->all());
                                                 $penalty=Penalty::first()->percentage_penalty;
                                                 $month_paid_penaty=$loan_schedule->monthpenaty->sum('amount_paid'); 
                                                          // actual all penalty
                                                  $monthpenalty=($penalty/100)*($loan_schedule->monthprinciple+$loan_schedule->monthinterest);

                                                 $month_paid_amount=$month_paid_interest+$month_paid_principle+$month_paid_penaty;

                                                $totalmonthpay=($loan_schedule->monthprinciple+$loan_schedule->monthinterest+$monthpenalty)-$month_paid_amount;

                                                $interest_to_pay=$loan_schedule->monthinterest-$month_paid_interest;


                                                $principle_to_pay=$loan_schedule->monthprinciple-$month_paid_principle;

                                                $penaty_to_pay=$monthpenalty-$month_paid_penaty;

                                                  $total_to_pay=($principle_to_pay+$interest_to_pay+$penaty_to_pay);
                                             

                  $member_penatyaccount=$member->memberaccount->where('name','=','Penaty Account')->first();
                      $main_penatyaccount=Mainaccount::where('name','=','Penaty Account')->first();


                             if($amountinput==$totalmonthpay){
                                                           
                                                       $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                             ]);  

                                                          //$newamount=0;
                                                           
                                                           $repayment->monthrepayment()->attach($loan_schedule->id);
                                                            $loan_schedule->status='paid';
                                                            $loan_schedule->save();

                                                           //payment



                                   Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatytaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);



                                                              //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]); 


                                      Bankaccount::create([

                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'dr'=>$principle_to_pay,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$principle_to_pay,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]); 

                                              //loan receivable
                                        Receivableaccount::create([
                                     'cr'=>$principle_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);
                                        




                                                          //penalty main account 

                                                 Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member account

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id,//$request->memberaccount_id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']); 


                                                        //principle main  

                                                 Journalentry::create(
                                                  [
                               
                                             'dr'=>$principle_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>$principle_to_pay, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);


                                                                //update penaty status
                                                   $monthpenaty=$loan_schedule->monthpenaty;
                                                  $monthpenaty->status="paid";
                                                    $monthpenaty->save(); 

                                              return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));
                                                             
                                                        break;        
                                                        
                                         }elseif($amountinput>$totalmonthpay){



                                                            
                                                          $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                   $newamount=$amountinput-$totalmonthpay;   
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='paid';
                                                                    $loan_schedule->save();

                                           Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatyaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);



                                                              //interest account

                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]); 


                                      Bankaccount::create([

                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'dr'=>$principle_to_pay,
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>$principle_to_pay,
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]); 

                                              //loan receivable
                                        Receivableaccount::create([
                                     'cr'=>$principle_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);
                                        




                                                          //penalty main account 

                                                 Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member account

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id,//$request->memberaccount_id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']); 


                                                        //principle main  

                                                 Journalentry::create(
                                                  [
                               
                                             'dr'=>$principle_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                             'cr'=>$principle_to_pay, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);



                                                    }elseif($amountinput<$totalmonthpay){

                                                      
                                                       if($amountinput<$penaty_to_pay){

                                                               
                                                         $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> 0,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$interest_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='incomplete';
                                                                    $loan_schedule->save();
                           

                                        Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatyaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);




                                                //store in jornal table 

                                     Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member accoount

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']);

                                                  
                                                //update penaty sataus
                                                 

                                              return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));
                                                              

                                       }elseif($amountinput<($penaty_to_pay+$interest_to_pay)){

                                            $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> 0,
                                                                  'interestpayed'=>($amountinput-$penaty_to_pay),
                                                                  'amountpayed'=>($amountinput-$penaty_to_pay),
                                                                'paymentdate'=>date('Y-m-d H:i:s'),
                                                        'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                $loan_schedule->status='incomplete';
                                                                $loan_schedule->save();



                                                            Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatyaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);


                                               //interest bank
                                                Bankaccount::create([

                                  'mainaccount_id'=>$bankaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>($amountinput-$penaty_to_pay),
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>($amountinput-$penaty_to_pay),
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]); 







                                                Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member accoount

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']);                     

                                                                   //interst main
                                                  Journalentry::create([
                                             'dr'=>($amountinput-$penaty_to_pay), 
                                             'mainaccount_id'=>$bankaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$amountinput-$penaty_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);

                                                     $monthpenaty=$loan_schedule->monthpenaty;
                                                  $monthpenaty->status="paid";
                                                    $monthpenaty->save(); 


                                                              return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));
                                                             
                                                              break;
                                                          
                                                        }elseif ($amountinput>=($penaty_to_pay+$interest_to_pay)) {

                                                               $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                'principlepayed'=>($amountinput-($penaty_to_pay+$interest_to_pay)),
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$amountinput,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::guard('member')->user()->member_id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='incomplete';
                                                                    $loan_schedule->save();



                                       Bankaccount::create([

                                  'mainaccount_id'=>$main_penatyaccount->id,
                                  'memberaccount_id'=>$member_penatyaccount->id,
                                  'dr'=>$penaty_to_pay,
                                  'description'=>'penaty',
                                  'date'=>date('Y-m-d')
                                      ]);

                                       //penaty account receivable 

                                      Receivableaccount::create([
                                     'cr'=>$penaty_to_pay,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$member_penatyaccount->id,
                                     'description'=>'penaty',
                                      'date'=>date('Y-m-d')
                                   ]);


                                               //interest bank
                                                Bankaccount::create([

                                  'mainaccount_id'=>$main_interestaccount->id,
                                  'memberaccount_id'=>$member_interestaccount->id,
                                  'dr'=>$interest_to_pay,
                                  'description'=>'interest',
                                  'date'=>date('Y-m-d')
                                      ]);


                                              //interest in receivable

                                       Receivableaccount::create([
                                     'cr'=>$interest_to_pay,
                                     'memberaccount_id'=>$member_interestaccount->id,
                                      'mainaccount_id'=>$bankaccount->id,
                                      'description'=>'interest',
                                       'date'=>date('Y-m-d')
                                   ]); 


                                               Bankaccount::create([

                                  'memberaccount_id'=>$request->memberaccount_id,
                                  'mainaccount_id'=>$request->mainaccount_id,
                                  'dr'=>($amountinput-($penaty_to_pay+$interest_to_pay)),
                                  'description'=>'loan',
                                  'date'=>date('Y-m-d')
                                      ]); 

                                     // dr bankaccount

                                       Loanaccount::create([
                                       'memberaccount_id'=>$request->memberaccount_id,
                                       'mainaccount_id'=>$bankaccount->id,
                                       'dr'=>($amountinput-($penaty_to_pay+$interest_to_pay)),
                                       'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                    ]); 

                                              //loan receivable
                                        Receivableaccount::create([
                                     'cr'=>($amountinput-($penaty_to_pay+$interest_to_pay)),
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'loan',
                                       'date'=>date('Y-m-d')
                                   ]);

                            
                                                    
                                       Journalentry::create(
                                                  [
                               
                                             'dr'=>$penaty_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id, //from penalty account
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'penaty']
                                   
                                                  ); 
                                                              //penalty member accoount

                                             Journalentry::create( [
                                             'cr'=>$penaty_to_pay, 
                                             'memberaccount_id'=>$member_penatyaccount->id, //from penalty account
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'penaty']); 
                      
                                                //store in jornal table 


                                                            //principle main
                                                      Journalentry::create(
                                                  [
                               
                                             'dr'=>($amountinput-($penaty_to_pay+$interest_to_pay)), 
                                             'mainaccount_id'=>$bankaccount->id,
                                              'payment_id'=>$payment->id,
                                              'date'=>date('Y-m-d'),
                                              'service_type'=>'loan']
                                   
                                                  ); 

                                                  //principle member

                                             Journalentry::create( [
                                            'cr'=>($amountinput-($penaty_to_pay+$interest_to_pay)), 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'loan']); 

                                                      //interst main
                                                  Journalentry::create([
                                             'dr'=>$interest_to_pay, 
                                             'mainaccount_id'=>$bankaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']); 

                                                   // interest member

                                                   Journalentry::create([
                                             'cr'=>$interest_to_pay, 
                                             'memberaccount_id'=>$member_interestaccount->id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'interest']);

                                                  
                                              
                                                    $monthpenaty=$loan_schedule->monthpenaty;
                                                  $monthpenaty->status="paid";
                                                    $monthpenaty->save(); 
                  

                                                  
                                              return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));
                                                             
                                                              break;



                                                          
                                                        }

                          
                                                } 
                                          if($newamount>0){


                                              $amountinput=$newamount;
                                                        } 
            else return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));
//next if  
                                              }    

                                                     
                                              }//loan status  

                                               
                                 }
                                   

                               }

                                 return back();
                          
                       }else if($request->payment_type=='share'){

                              $share=Share::sum('share_value');
                             $max_shares=Share::select('max_shares')->first()->max_shares;
                                    
                                   $no_share=Member::find($request->member)->no_shares->sum('No_shares');
        
                                             if($no_share<$max_shares){


                                   
                         $share=Member_share::create([
                              
                               'member_id'=>$request->member,
                               'amount'=>$request->payment,
                               'share_date'=>date('Y-m-d H:i:s'),
                               'user_id'=>Auth::guard('member')->user()->member_id,
                               'No_shares'=>$request->payment/$share

                         ]);

                                 $payment=Payment::create([
                                 'member_share_id'=>$share->id,
                                 'amount'=>$request->payment,
                                 'narration'=>$request->narration,
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>$request->payment_method,
                                 'state'=>'in',
                                 'date'=>date('Y-m-d')
                             
                         ]);
                               


                                   //jornal cr main saccoss

                                      Bankaccount::create([
                                       'dr'=>$request->payment,
                                        'mainaccount_id'=>$request->mainaccount_id,
                                        'memberaccount_id'=>$request->memberaccount_id,
                                        'description'=>'share',
                                         'date'=>date('Y-m-d')
                                            
                                      ]);

                                       Payableaccount::create([
                                       'member_share_id'=>$share->id,
                                       'cr'=>$request->payment,
                                       'date'=>date('Y-m-d')
                                       ]);

                                       Journalentry::create( [
                                             'cr'=>$request->payment, 
                                             'mainaccount_id'=>$request->mainaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'share']); 


                                  //jornal dr member share account

                                        Journalentry::create( [
                                             'dr'=>$request->payment, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'share']); 




                          return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member')); 
                } else{


                    return back()->with('error','No more shares are needed');
                }
                  

                     }elseif($request->payment_type=='saving'){
     
                           $saving=Membersaving::create([
                               
                               'member_id'=>$request->member,
                               'saving_code'=>1111,
                               'amount'=>$request->payment,
                               'user_id'=>Auth::guard('member')->user()->member_id,
                               'saving_date'=>date('Y-m-d H:i:s')
                           ]);


                                  $payment=Payment::create([
                                 'membersaving_id'=>$saving->id,
                                 'amount'=>$request->payment,
                                 'narration'=>$request->narration,
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>$request->payment_method,
                                 'state'=>'in',
                                 'date'=>date('Y-m-d')
                             
                         ]);


                                     Bankaccount::create([
                                       'dr'=>$request->payment,
                                        'mainaccount_id'=>$request->mainaccount_id,
                                        'memberaccount_id'=>$request->memberaccount_id,
                                        'description'=>'saving',
                                         'date'=>date('Y-m-d')
                                            
                                      ]);

                                       Payableaccount::create([
                                       'membersaving_id'=>$saving->id,
                                       'cr'=>$request->payment,
                                       'date'=>date('Y-m-d')
                                       ]);
                                      

                                       //jornal dr main saving account
                               Journalentry::create( [
                                             'cr'=>$request->payment, 
                                             'mainaccount_id'=>$request->mainaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'saving']); 

                                  //jornal dr member saving account

                                        Journalentry::create( [
                                             'dr'=>$request->payment, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'saving']); 


                            return view('loans.receipt.repayment',compact('amountinput','getpaymenttype','member'));



                     }else{ 
                                 $member=Member::find($member_id);
                                  if($request->payment==$member->regfee->amount){
                                  
                                  $memberregfee=$member->regfee;
                                  $memberregfee->status='paid';
                                   $memberregfee->save();

                                  $member->status='active';
                                  $member->save();

                                 $payment=Payment::create([
                                 'regfee_id'=>$memberregfee->id,
                                 'amount'=>$request->payment,
                                 'narration'=>$request->narration,
                                 'paid_by'=>Auth::guard('member')->user()->member_id, 
                                 'payment_type'=>$request->payment_method,
                                 'state'=>'in',
                                 'date'=>date('Y-m-d')  
                         ]);


                                    Bankaccount::create([
                                       'dr'=>$request->payment,
                                        'mainaccount_id'=>$request->mainaccount_id,
                                        'memberaccount_id'=>$request->memberaccount_id,
                                        'description'=>'registration fee',
                                         'date'=>date('Y-m-d')
                                            
                                      ]); 



                                      Receivableaccount::create([
                                     'cr'=>$request->payment,
                                     'mainaccount_id'=>$bankaccount->id,
                                     'memberaccount_id'=>$request->memberaccount_id,
                                      'description'=>'registration fee',
                                       'date'=>date('Y-m-d')
                                   ]);


                                        Journalentry::create( [
                                             'cr'=>$request->payment, 
                                             'mainaccount_id'=>$request->mainaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'registration fee']); 

                                  //jornal dr member saving account

                                        Journalentry::create( [
                                             'dr'=>$request->payment, 
                                             'memberaccount_id'=>$request->memberaccount_id,
                                             'payment_id'=>$payment->id,
                                             'date'=>date('Y-m-d'),
                                             'service_type'=>'registration fee']); 


                               }else{

                                 return back()->with('error','Please enter the fee required');
                               }


                     }

                
                    }


                    public function repayment_slip($member_id,$amountinput,$getpaymenttype){

                          $member=Member::find($member_id);

                         $pdf = PDF::loadView('loans.receipt.repayment',compact('member','amountinput','getpaymenttype'));
                          return $pdf->download('paid.pdf');
                          
                    }



       

}


                       