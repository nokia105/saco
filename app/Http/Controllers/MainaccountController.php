<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include(app_path()."\datatable\Editor\php\DataTables.php" );
include(app_path()."\datatable\Editor\php\config.php" );
include(app_path()."\datatable\Editor\php\Bootstrap.php" );
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

use App\Mainaccount;
use App\Expense;
use App\Payment; 
use App\Journalentry;
use App\Bankaccount;
use Auth;
use App\Categoryaccount;   


class MainaccountController extends Controller
{
    //


    public function db(){

// DataTables PHP library
$sql_details = array(
    "type" => "Mysql",  // Database type: "Mysql", "Postgres", "Sqlite" or "Sqlserver"
    "user" => "root",       // Database user name
    "pass" => "",       // Database password
    "host" => "localhost",       // Database host
    "port" => "",       // Database connection port (can be left empty for default)
    "db"   => "saccoss"     // Database name
    //"dsn"  => "charset=utf8"        // PHP DSN extra information. Set as `charset=utf8` if you are using MySQL
);   // Database name
    //"dsn"  => "charset=utf8"        // PHP DSN extra information. Set as `charset=utf8` if you are using MySQL

return $db = new \DataTables\Database($sql_details );
  } 



  public function index(){

     Editor::inst($this->db(),'mainaccounts','id')
    ->fields(
        Field::inst('mainaccounts.account_no')->validator('Validate::notEmpty' ),
        Field::inst('mainaccounts.name')->validator('Validate::notEmpty' ),
        Field::inst('mainaccounts.categoryaccountstype_id')
        ->options( 'categoryaccountstypes', 'id','name'),             
        Field::inst( 'categoryaccountstypes.name' )
    )   
     ->leftJoin('categoryaccountstypes','categoryaccountstypes.id','=', 'mainaccounts.categoryaccountstype_id' ) 
    ->process( $_GET )
    ->json();
    }


      public function expenses(){


          $expensesaccounts=Categoryaccount::where('name','=','Expenses')->first()->mainaccounts;
           
         return view('Expenses.expenses',compact('expensesaccounts'));
      }


      public function expenseajax(Request $request){

              $expenseaccount=Mainaccount::find($request->account_to);

             if($request->account_from=='bank'){ 

              echo json_encode([

                 'account_from'=>'Bank Account',
                  'account_to'=>$expenseaccount->name
              ]);


             }elseif($request->account_from=='cash'){
               
              echo json_encode([

                 'account_from'=>'Cash Account',
                  'account_to'=>$expenseaccount->name
              ]);
   

             }

      }

        public function storeexpenses(Request $request){

               $payment=Payment::create([
                 'amount'=>$request->payment,
                 'narration'=>$request->narration,
                 'paid_by'=>Auth::guard('member')->user()->member_id,  //loan payment verificat
                 'payment_type'=>'bank',
                 'state'=>'out',
                 'date'=>date('Y-m-d')
                             
                  ]);

            if($request->account_from=='bank'){ 

               $bankaccount=Mainaccount::where('name','=','Bank Account')
                                            ->first();
                $expenseaccount=Mainaccount::find($request->account_to);
                   Bankaccount::create([
                'mainaccount_id'=>$request->account_to,
                'cr'=>$request->payment,
                'description'=>$expenseaccount->name,
                'date'=>date('Y-m-d')
                  ]);

                  Expense::create([
                    'dr'=>$request->payment,
                    'mainaccount_id'=>$request->account_to,
                    'date'=>date('Y-m-d')
                  ]);
                     //jornal for bank
     Journalentry::create(
    [
   'cr'=>$request->payment, 
    'mainaccount_id'=>$bankaccount->id,
    'payment_id'=>$payment->id,
    'date'=>date('Y-m-d'),
   'service_type'=>'expenses']
                                   
    ); 
    
     //jornal for expenses account            

   Journalentry::create(
    [
   'dr'=>$request->payment, 
    'mainaccount_id'=>$expenseaccount->id,
    'payment_id'=>$payment->id,
    'date'=>date('Y-m-d'),
   'service_type'=>'expenses']
                                   
    );


      return back()->with('status','Successfully paid');

            
                 }elseif($request->account_from=='cash'){

                $cashaccount=Mainaccount::where('name','=','Cash Account')
                                            ->first();
                                            
                              $expenseaccount=Mainaccount::find($request->account_to);
                   Bankaccount::create([
                'mainaccount_id'=>$request->account_to,
                'cr'=>$request->payment,
                'description'=>$expenseaccount->name,
                'date'=>date('Y-m-d')
                  ]);

                  Expenses::create([
                    'dr'=>$request->payment,
                    'mainaccount_id'=>$request->account_to,
                    'date'=>date('Y-m-d')
                  ]);
                     //jornal for bank
     Journalentry::create(
    [
   'cr'=>$request->payment, 
    'mainaccount_id'=>$cashaccount->id,
    'payment_id'=>$payment->id,
    'date'=>date('Y-m-d'),
   'service_type'=>'expenses']
                                   
    ); 
    
     //jornal for expenses account            

   Journalentry::create(
    [
   'dr'=>$request->payment, 
    'mainaccount_id'=>$expenseaccount->id,
    'payment_id'=>$payment->id,
    'date'=>date('Y-m-d'),
   'service_type'=>'expenses']
                                   
    );    

         return back()->with('status','Successfully paid') ;             


                 }
        }


}
