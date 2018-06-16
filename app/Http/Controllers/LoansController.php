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

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

     public function newloan_receive($id){

         
          $code=Code::where('name','=','loan')->first()->code_number;

            $loan=Loan::find($id);

            $loancollaterals=Loan::find($id)->collaterals;
               
               $loanguarantors=Loan::find($id)->guarantor;

               $insurance=Insurance::first();

               $loanfees=Loan::find($id)->loan_fees;
         

            return view('loans.received.newloan_receive',compact('code','loan','loancollaterals','loanguarantors','insurance','loanfees'));
     }


    public function create(Request $request,$id)
    {
        
                     
        


}


   public function approve($id){

         $loan=Loan::find($id);

        return view('modal.approve',compact('loanprinciple','loanduratuion','loan'));

   }

   public function approve_submitted(Request $request){

                       $this->validate(request(),[
                         'approve_reason'=>'required',

                          'approve_workingdate'=>'required'

                       ]);
   
                     $loan=Loan::find($request->loan_id);
     
                     $loan->loan_status='approved';
                     $loan->action_reason=$request->approve_reason;
                     $loan->action_date=date('Y-m-d');
                     $loan->action_workingdate=$request->approve_workingdate;
                     $loan->action_person=Auth::user()->id;
                     $loan->save();   

                          for($i=0; $i<$loan->duration; $i++){

                            $duedate=date('Y-m-d', strtotime($i.' month', strtotime($loan->action_workingdate)));
                                Loanschedule::create([
                                               
                                                'loan_id'=>$loan->id,
                                                 
                                                 'monthprinciple'=>$loan->mounthlyrepayment_principle,
                                                 'monthinterest'=>$loan->mounthlyrepayment_interest,
                                                 'duedate'=>$duedate,
                                                 'month'=>date('m',strtotime($duedate))

                           ]);

                           }

                     
                      return back()->with('status','approved'); 





   }



       public function reject($id){

          $loan=Loan::find($id);
      return view('modal.reject',compact('loan')); 


   }

      public function reject_submitted(Request $request){

                     $this->validate(request(),[
                         'reject_reason'=>'required',
                       ]);

                     $loan=Loan::find($request->loan_id);
                     
                     $loan->loan_status='rejected';
                     $loan->action_reason=$request->reject_reason;
                     $loan->action_date=date('Y-m-d');
                     $loan->action_person=Auth::user()->id;
                  
                     $loan->save(); 

                     return back()->with('status',' rejected'); 
      }



        public function pending($id){

          $loan=Loan::find($id);
      return view('modal.pending',compact('loan')); 


   }


      public function pending_submitted(Request $request){

                  $this->validate(request(),[
                         'pending_reason'=>'required',

                          'pending_workingdate'=>'required'

                       ]); 

                      $loan=Loan::find($request->loan_id);


                     $loan->loan_status='pendding';
                     $loan->action_reason=$request->pending_reason;
                     $loan->action_date=date('Y-m-d');
                     $loan->action_workingdate=$request->pending_workingdate;
                     $loan->action_person=Auth::user()->id;
                   
                     $loan->save(); 

                     return back()->with('status',' pending'); 
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
        //
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response


     */
}
    public function destroy($id)
    {
        //
    }
}
