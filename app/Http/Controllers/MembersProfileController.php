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
            $fees=Feescategory::all();
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
                       

                     if($differ_register_days<=90){

                               //testing purpose <=
                         if($no_shares==$max_shares){

                   if($request->has('collate')){
                      
                  $totalcollateral_value=Collateral::find($collate_id)->sum('colateral_value');

                   if(/*$principle<=(80/100*$totalcollateral_value+$totalsaving ) ||*/ $principle<=80/100*$totalcollateral_value ){
                            
                             $loan=Loan::create([
                            'loanInssue_date'=>date('Y-m-d H:i:s'),
                            'inssued_by'=>Auth::user()->id,

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

                            'loanInssue_date'=>date('Y-m-d H:i:s'),
                            'inssued_by'=>Auth::user()->id,
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


                    /*           for($i=0; $i<$loanperiod; $i++){
                            $duedate=date('Y-m-d', strtotime($i.' month', strtotime($startpayment)));
                Loanschedule::create([
                             
                              'loan_id'=>$loan->id, 
                               'monthprinciple'=>$principle/$loanperiod,
                               'monthinterest'=>(($interest/100)*$principle)/$loanperiod,
                               'duedate'=>$duedate,
                               'month'=>date('m',strtotime($duedate))

                           ]);

                           }*/

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

       $loanlists=Member::find($id)->loanlist->where('loan_status','=','approved');
            
           
        

        //dd($loanlist->interrepayment->sum('amountpayed'));
      return view('loans.loanlist' , compact('loanlists','id','code')); 
    }

  public function editloan($id){
            $loan_id=request()->segment(4);
            $username=Auth::user()->name;
            $member=Member::find($id);
            $collaterals=Member::find($id)->collateral;       
            $loancategories=LoanCategory::select('id','category_name')->get();
            $guarantors=Member::all()->where('member_id','!=',$id);
            $fees=Feescategory::all();
            $loans=Loan::all()->where('id','=',$loan_id);
            $member_id=$id;
            return view('loans.editloan',compact('loancategories','username','member','collaterals','guarantors','fees','loans','member_id'));
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
          

           $loanperiod=$request->period;
           $principle=$request->principle;
            $interest=$request->interest;
           $member_id=$request->memberloan;
            $loan_id=$request->loanid; 
            $collate_id=$request->collate;
            $guarator_id=$request->guarantor;
            $charges=$request->charges;
           $loan=Loan::find($loan_id);



                  if($request->has('collate')){
                      
                  $totalcollateral_value=Collateral::find($collate_id)->sum('colateral_value');

                   if($principle<=80/100*$totalcollateral_value){

                  
                   DB::table('loans')
            ->where('id', $loan_id)
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
                 'user_id'=>Auth::user()->id //to be deleted
               ]);
                Loaninsuarance::create([
                     'loan_id'=>$loan_id,
                     'insuarance_pacentage'=>234.678
                 ]);        
              $loan->collaterals()->sync($collate_id);
              $loan->guarantor()->sync( $guarator_id);
              $loan->loan_fees()->sync($charges);

                Loanschedule::where('loan_id','=',$loan_id)->delete();

                         for($i=0; $i<$loanperiod; $i++){
                Loanschedule::create([
                             
                                'loan_id'=>$loan_id,
                               'month'=>date('m',strtotime($request->startpayment))+$i,
                               'monthprinciple'=>$principle/$loanperiod,
                               'monthinterest'=>(($interest/100)*$principle)/$loanperiod,
                               'duedate'=>date('Y-m-d', strtotime($i+1 .' month', strtotime($request->startpayment))),

                           ]);

                           }

                     return back()->with('status','your loan is accepted');   

                      

                   }

                    return back()->with('error','your loan must be 80% of your collaterals')->withInput();


                   }else{

                     $totalsaving=Member::find($member_id)->savingamount->sum('amount');

                if($principle<=3*$totalsaving){
            DB::table('loans')
            ->where('id', $loan_id)
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
                 'user_id'=>Auth::user()->id
               ]);

     
                
              $loan->guarantor()->sync( $guarator_id);
              $loan->loan_fees()->sync($charges);

                Loanschedule::where('loan_id','=',$loan_id)->delete();


                         for($i=0; $i<$loanperiod; $i++){
                $loanschedule=Loanschedule::create([
                             
                                'loan_id'=>$loan_id,
                               'month'=>date('m',strtotime($request->startpayment))+$i,
                               'monthprinciple'=>$principle/$loanperiod,
                               'monthinterest'=>(($interest/100)*$principle)/$loanperiod,
                               'duedate'=>date('Y-m-d', strtotime($i+1 .' month', strtotime($request->startpayment))),

                           ]);

                           }

                    

            
  return redirect()->route('loanlist',['id'=>$member_id]) ; 

  }
   return back()->with('error','You asked for a loan which is more than your savings'); 
 }


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
             
        // return view('loans.loanrepaymentpdf',compact('principle','interest','period','firstpayment','monthlyrepayment','montlyinterest'));
    }



      public function schedule(){

           $loan_id=request()->segment(4);
           $member_id=request()->segment(2);

           $loan=Loan::find($loan_id);

            $loancollaterals=Loan::find( $loan_id)->collaterals;
               
               $loanguarantors=Loan::find($loan_id)->guarantor;

               $insurance=Insurance::first();

               $loanfees=Loan::find( $loan_id)->loan_fees;
         

          $code=Code::where('name','=','loan')->first()->code_number;


           //$code=2000+$loan_id+$id;



           return view('loans.schedule',compact('loan','code','loan_id','member_id','loancollaterals','loanguarantors','insurance','loanfees'));
      }



      public function payment(){

        return view('loans.payment');
      }

       public function storepayments(Request $request){


                      $this->validate(request(),[
                            'payment_type'=>'required',
                            'payment'=>'required|numeric'
                      ]);
                  $amountinput=$request->payment;

                  $newamount=0;
                      
                if($request->payment_type=='loan'){
                    $member_loans=Member::find($request->member)->loanlist->where('loan_status','=','active');
                                  

                       foreach($member_loans as $loan){
                           
                          foreach($loan->loanschedule  as $loan_schedule){
                             
                               $month_paid_interest=$loan_schedule->monthrepayment->sum('interestpayed');
                                $month_paid_principle=$loan_schedule->monthrepayment->sum('principlepayed');
                                $month_paid_amount=$month_paid_interest+$month_paid_principle;
                                      
                                         

                                           // dd($loan_schedule);
                                 if($loan_schedule->status!='paid') {
                                                      //get first row in table
                                          $totalmonthpay=($loan_schedule->monthprinciple+$loan_schedule->monthinterest)-$month_paid_amount;


                                              

                                            $interest_to_pay=$loan_schedule->monthinterest-$month_paid_interest;


                                                $principle_to_pay=$loan_schedule->monthprinciple-$month_paid_principle;

                                                         $total_to_pay=($principle_to_pay+$interest_to_pay);
                                                          
                                                          if($amountinput==$totalmonthpay){         
                                                               
                                                             $repayment=Repayment::create([
                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::user()->id

                                                             ]);  

                                                          //$newamount=0;
                                                           
                                                           $repayment->monthrepayment()->attach($loan_schedule->id);
                                                            $loan_schedule->status='paid';
                                                            $loan_schedule->save();

                                                                         
                                                      /*if($loan->loanrepayment->sum('amountpayed')==($loan_schedule->sum('monthprinciple')+$loan_schedule->sum('monthinterest'))){

                                                     $loan->loan_status='inactive';
                                                      $loan->save();*/
                                                              return back()->with('status','Loan deposited'); 
                                                              break; 

                                                        

                                               }
                                               else if($amountinput>$totalmonthpay){

                                                           
                                                           $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=> $principle_to_pay,
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$total_to_pay,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::user()->id

                                                 ]);  

                                                                    $newamount=$amountinput-$totalmonthpay;
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='paid';
                                                                    $loan_schedule->save();
                                                                    

                                                  
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
                                                                  'user_id'=>Auth::user()->id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='incomplete';
                                                                    $loan_schedule->save();

                                                  
                                                              return back()->with('status','Loan repaid'); 
                                                             
                                                              break;
                                                              

                                                        }else if($amountinput>=$interest_to_pay){


                                                                        


                                                                   $repayment=Repayment::create([

                                                                  'loanschedule_id'=>$loan_schedule->id,
                                                                  'principlepayed'=>($amountinput-$interest_to_pay),
                                                                  'interestpayed'=>$interest_to_pay,
                                                                  'amountpayed'=>$amountinput,
                                                                  'paymentdate'=>date('Y-m-d H:i:s'),
                                                                  'user_id'=>Auth::user()->id

                                                 ]);  

                                                                    $newamount=0;
                                                                   
                                                                    $repayment->monthrepayment()->attach($loan_schedule->id);
                                                                    $loan_schedule->status='incomplete';
                                                                    $loan_schedule->save();

                                                  
                                                              return back()->with('status','Loan deposited'); 
                                                             
                                                              break;


                                                        } 


                                                   
                                                       

                                               }



                                                if($newamount>0){


                                                           $amountinput=$newamount;
                                                        } 
                                                else return back()->with('status','Loan repaid');

                                              }//loan status               
                                               
                                 }
                                   

                               }

                                 return back();
                          
                       }else if($request->payment_type=='share'){

                              $share=Share::sum('share_value');
                             $max_shares=Share::select('max_shares')->first()->max_shares;
                                    
                                   $no_share=Member::find($request->member)->no_shares->sum('No_shares');
        
                                             if($no_share<$max_shares){                           

                         Member_share::create([
                              
                               'member_id'=>$request->member,
                               'amount'=>$request->payment,
                               'share_date'=>date('Y-m-d H:i:s'),
                               'user_id'=>Auth::user()->id,
                               'No_shares'=>$request->payment/$share

                         ]);

                          return back()->with('status','your share deposited'); 
                } else{


                    return back()->with('error','No more shares are needed');
                }
                  

                     }else{

                                  
                           Membersaving::create([
                               
                               'member_id'=>$request->member,
                               'saving_code'=>1111,
                               'amount'=>$request->payment,
                               'user_id'=>Auth::user()->id,
                               'saving_date'=>date('Y-m-d H:i:s')
                           ]);

                            return back()->with('status','your savings deposited'); 

                     }

                
                    }



       

}


                       