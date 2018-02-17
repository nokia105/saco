<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\User;
use Auth;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        
        return view('member.member');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
/*
        $this->validate(request(),[

         'firstname'=>'required',
         'middlename'=>'required',
         'lastname'=>'required',
         'email'=>'required',
         'phone'=>'required',
         'bankname'=>'required',
         'accountnumber'=>'required',
         'nextkinname'=>'required',
         'nextkinrelashiship'=>'required',


        ]);
*/

         Member::create([

          'firstname'=>request('firstname'),
          'middlename'=>request('middlename'),
          'lastname'=>request('lastname'),
           'password'=>'password',   
          'email'=>request('email'),
          'phone'=>request('phone'),
          'bankname'=>request('bankname'),
          'accountnumber'=>request('accountnumber'),
          'nextkinname'=>request('nextkinname'),
          'nextkinrelationship'=>request('nextkinrelashioship'),
           'joiningdate'=>date('Y-m-d H:i:s'),
          'status'=>1,
          'user_id'=>Auth::user()->id
         ]);

            $members=Member::all();

          

            return view('member.show',compact('members'));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
