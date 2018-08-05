<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Member;
use Auth;
use App\Memberaccount;
use App\Glaccount;
use App\Categoryaccount;
use Illuminate\Validation\Rule;
use App\Regfee; 
use App\Feescategory;


class MembersController extends Controller
{
   
        
     function __construct(){

       return $this->middleware('auth:member');
     }  

         public function index(){

            $members=Member::all();

           return view('member.member',compact('members'));
         }


  public function registerform(){

               $memberlastid=Member::all()->last()->member_id+1;
               if (strlen($memberlastid)==1 ) $regno='000'.$memberlastid.'';
               else if (strlen($memberlastid)==2 ) $regno='00'.$memberlastid.'';
               else if (strlen($memberlastid)==3 ) $regno='0'.$memberlastid.'';
               else if (strlen($memberlastid)>3 ) $regno=$memberlastid.'';

                $reg='TS/MR/'.$regno;

  	   return view('member.registerform',compact('reg'));
  }



   public function saveregister(Request $request, Member $member){

             // dd($request->all());
   	
   	      $validator=$this->validate(request(),[
              'firstname'=>'required',
              'middlename'=>'required',
              'lastname'=>'required',
              'reg_no'=>'required',
               'phone'=> [
        'required',
        'min:10',
        'max:13',
        Rule::unique('members')->ignore($member->id,'member_id'),
    ],
               'email' => [
        'required',
        Rule::unique('members')->ignore($member->id,'member_id'),
    ],
               'bank'=>'required',
               'account'=>'required',
               'kin_name'=>'required',
               'kin_relashioship'=>'required',
               'gender'=>'required',
               'box'=>'required',
               'street'=>'required',
               'house'=>'required',
               'b_date'=>'required',
               'status'=>'required'       
           ]);

   	  $member=Member::create([
        'first_name'=>$request->firstname,
        'middle_name'=>$request->middlename,
        'last_name'=>$request->lastname,
         'registration_no'=>$request->reg_no,
         'status'=>'inactive',
         'user_id'=>Auth::guard('member')->user()->member_id,
         'phone'=>$request->phone,
         'password'=>bcrypt('password'),
         'email'=>$request->email,
         'bank_name'=>$request->bank,
         'account_number'=>$request->account,
         'nextkin_name'=>$request->kin_name,
         'nextkin_relationship'=>$request->kin_relashioship,
         'marital_status'=>$request->status,
         'couple_names'=>$request->couple,
         'gender'=>$request->gender,
         'box_number'=>$request->box,
         'street_name'=>$request->street,
         'house_no'=>$request->house,
         'birth_date'=>$request->b_date,
         'joining_date'=>date('Y-m-d')
   	  ]);

               //  rondom account number

   	         //loan account

           $loanfee=Feescategory::where('name','=','Registration fee')->first();

         Regfee::create([
          'amount'=>$loanfee->fee_value,
          'member_id'=>$member->member_id,
          'status'=>'unpaid'
         ]); 


   	        $liability=Categoryaccount::where('name','=','Liability')->first();
            $asset=Categoryaccount::where('name','=','Asset')->first();
            $capital=Categoryaccount::where('name','=','Capital')->first();

             $saving=Mainaccount::where('name','=','Saving Account')->first();
             $share=Mainaccount::where('name','=','Share Account')->first();
             $loan=Mainaccount::where('name','=','Loan Account')->first();
             $interest=Mainaccount::where('name','=','Interest Account')->first();
             $penaty=Mainaccount::where('name','=','Penaty Account')->first();
             $registration=Mainaccount::where('name','=','Registration Fee')->first();
            

               //dd($asset);

   	        $memberloan=Memberaccount::create([
      
                     'member_id'=>$member->member_id,
                      
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Loan Account',
                      'account_no'=>$loan->id.'M'.($member->member_id),
                      'date'=>date('Y-m-d')
   	      ]);

              
   	     
   	         $membersaving=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$saving->account_no.'M'.($member->member_id),
                      'categoryaccount_id'=>$asset->id,
                      'name'=>'Saving Account',
                      'date'=>date('Y-m-d')
   	        ]);

   	      //share account 
           
   	          $membershare=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$share->account_no.'M'.($member->member_id),
                      'categoryaccount_id'=>$asset->id,
                      'name'=>'Share Account',
                      'date'=>date('Y-m-d')
   	        ]);

   	     //interest account
   	          
   	      $memberinterest=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$interest->account_no.'M'.($member->member_id),
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Interest Account',
                      'date'=>date('Y-m-d')
   	        ]); 

   	     //penalty account
            
   	        $memberpenaty=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$penaty->account_no.'M'.($member->member_id),
                      'categoryaccount_id'=>$liability->id,
                      'name'=>'Penaty Account',
                      'date'=>date('Y-m-d')
   	        ]);

   	     //charges account
            
   	     //insurance account
             
   	           /* $memberinsurance=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$capital->code.(6000+$member->member_id),
                      'categoryaccount_id'=>$capital->id,
                      'name'=>'Insurance Account',
                      'date'=>date('Y-m-d')
   	        ]);*/

                                 //registration
                   $memberregistration=Memberaccount::create([
                      'member_id'=>$member->member_id,
                      'account_no'=>$registration.'M'.($member->member_id),
                      'categoryaccount_id'=>$capital->id,
                      'name'=>'Registration Fee',
                      'date'=>date('Y-m-d')
            ]);

   	             return back()->with('status','Registered Sucessfully');

   }


       public function edit($id){

           $member=Member::findorfail($id);

           return view('member.edit',compact('member'));
       }
     
        public function update(Member $member, $id, Request $request){
    $validator=$this->validate(request(),[
              'firstname'=>'required',
              'middlename'=>'required',
              'lastname'=>'required',
              'reg_no'=>'required',
               'phone'=>'required',
               'email' =>'required|email',
               'bank'=>'required',
               'account'=>'required',
               'kin_name'=>'required',
               'kin_relashioship'=>'required',
               'gender'=>'required',
               'box'=>'required',
               'street'=>'required',
               'house'=>'required',
               'b_date'=>'required',
               'status'=>'required'       
           ]);

              


             //$memberData=$request->all();

              $member=Member::find($id)->update([

         'first_name'=>$request->firstname,
         'middle_name'=>$request->middlename,
         'last_name'=>$request->lastname,
         'registration_no'=>$request->reg_no,
         'user_id'=>Auth::guard('member')->user()->member_id,
         'phone'=>$request->phone,
         'email'=>$request->email,
         'bank_name'=>$request->bank,
         'account_number'=>$request->account,
         'nextkin_name'=>$request->kin_name,
         'nextkin_relationship'=>$request->kin_relashioship,
         'marital_status'=>$request->status,
         'couple_names'=>$request->couple,
         'gender'=>$request->gender,
         'box_number'=>$request->box,
         'street_name'=>$request->street,
         'house_no'=>$request->house,
         'birth_date'=>$request->b_date,
              ]);





                       
             return redirect()->route('members')->with('status','Successfully Updated');
        }

     
         public function delete($id){

               $member=Member::find($id);

               $member->memberaccount()->delete();

               $member->delete();





                //delete all member account

               return redirect()->route('members')->with('status','Successfully Deleted');
         }
      

      
}
