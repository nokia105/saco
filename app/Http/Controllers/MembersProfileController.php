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

class MembersProfileController extends Controller
{
    // 

  public function cover($mprofileid){

    
    return view('loans.profile');
  }

     // public function index($mprofileid){

     //    $member=Member::find($mprofileid);
  

     //      return view('loans.profile',compact('member'));
     // }


      public function newloan($id){

            
            $username=Auth::user()->name;

            $member=Member::find($id);
         
            $collaterals=Member::find($id)->collateral;      
              
            $loancategories=LoanCategory::select('id','category_name')->get();

            $guarantors=Member::all()->where('member_id','!=',$id);
            $fees=Feescategory::all();
            return view('loans.newloan',compact('loancategories','username','member','collaterals','guarantors','fees'));
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
            $loanperiod=$request->loanperiod;
            $loanwm=$request->loanwm;
            $startpayment=$request->startpayment;
             //colateral from js field  
            $collate_id=$request->collate;
            $guarator_id=$request->guarantor;
            $charges=$request->charges;
            $user_id=Auth::user()->id; 

             //$mInterest=($interest/100)*$principle;

               $no_shares=Member::find($member_id)->no_shares->sum('No_shares');
                
                  $max_shares=Share::select('max_shares')->first()->max_shares;
               
                 if($no_shares==$max_shares){

                  $totalsaving=Member::find($member_id)->savingamount->sum('amount');

                   
                     
                    if($principle<=3*$totalsaving){

               $loan=Loan::create([
                  'loanInssue_date'=>date('Y-m-d H:i:s'),
                  'inssued_by'=>$user_id,
                  'loan_status'=>'active',
                  'loancategory_id'=>$pcategory_id,
                  'member_id'=>$member_id,
                  'duration'=>$loanperiod,
                  'interest_method'=> $Imethod,
                  'interest'=>$interest,
                  'principle'=>$principle,
                  'repayment_date'=>$startpayment,
                  'no_of_installments'=>$loanperiod,
                  'mounthlyrepayment_amount'=>($principle/$loanperiod)+(($interest/100)*$principle)/$loanperiod,//total monthly pricinple+m.niterest+other changes 1month
                  'mounthlyrepayment_principle'=>$principle/$loanperiod, 
                 'mounthlyrepayment_interest'=>(($interest/100)*$principle)/$loanperiod
               ]);
                /* Loaninsuarance::create([
                     'loan_id'=>$loan->id,
                     'insuarance_pacentage'=>234.678
                 ]); */        
              $loan->collaterals()->attach($collate_id);
              $loan->guarantor()->attach( $guarator_id);
              $loan->loan_fees()->attach($charges);

                     return back();

              }

                 return redirect('/savings');

              

              }

              return redirect('/');
      }

   public function loanlist($id)
      {
      

       $loanlists=Member::find($id)->loanlist;
      return view('loans.loanlist' , compact('loanlists','id')); 
    }

  public function editloan($id){
            $username=Auth::user()->name;
            $member=Member::find($id);
            $collaterals=Member::find($id)->collateral;       
            $loancategories=LoanCategory::select('id','category_name')->get();
            $guarantors=Member::all()->where('member_id','!=',$id);
            $fees=Feescategory::all();
            $loans=Loan::select('*')->get();
            $member_id=$id;
            return view('loans.editloan',compact('loancategories','username','member','collaterals','guarantors','fees','loans','member_id'));
          }
public function updateloan(Request $request)
 
 {  


           $loanperiod=$request->loanperiod;
           $principle=$request->principle;
            $interest=$request->interest;
           $member_id=$request->memberloan;
            $loan_id=$request->loanid; 
            $collate_id=$request->collate;
            $guarator_id=$request->guarantor;
            $charges=$request->charges;

                $totalsaving=Member::find($member_id)->savingamount->sum('amount');

                if($principle<=3*$totalsaving){
            DB::table('loans')
            ->where('id', $loan_id)
            ->update([
                  'loancategory_id'=>$request->pcategory,
                  'duration'=>$request->loanperiod,
                  'interest'=>$request->interest,
                  'principle'=>$request->principle,
                  'repayment_date'=>$request->startpayment,
                  'no_of_installments'=>$request->loanperiod,
                  'mounthlyrepayment_amount'=>($principle/$loanperiod)+(($interest/100)*$principle)/$loanperiod,
                  'mounthlyrepayment_principle'=>$principle/$loanperiod,
                 'mounthlyrepayment_interest'=>(($interest/100)*$principle)/$loanperiod
               ]);

     
                $loan=Loan::find($loan_id);
            $loan->collaterals()->sync($collate_id);
              $loan->guarantor()->sync( $guarator_id);
              $loan->loan_fees()->sync($charges);


            
  return redirect()->route('loanlist',['id'=>$member_id]) ; 

  }
   return back(); 
 }

}
