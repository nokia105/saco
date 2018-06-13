<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MemberloginController extends Controller
{
    //


       public function __construct(){

     	//$this->middleware('guest:member');
     }


      public function showLoginForm()

      {


      	 return view('member.login');
      }


        public function login(Request $request){

        	 //validate form 
        	/*$this->validate($request,[
                      
                    'email'=>'required|email',
                    'password'=>'required|min:6' 
        	]);*/


        	 if(Auth::guard('member')->attempt([

                 'email'=>$request->email,
                 'password'=>$request->password,
        	 ],$request->remember)){


              return redirect()->intended(route('/'));
        	 }

                   return redirect()->back()->withInput($request->only('email','remember'));
        }
}
