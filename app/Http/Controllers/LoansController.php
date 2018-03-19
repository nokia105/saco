<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shares;
use App\User;
use Auth;

class SharesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    return view('shares.shares');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        
        return view('shares.shares');
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

         Loan::create([

          'share_value'=>request('sharevalue'),
          'min_shares'=>request('minshares'),
          'max_shares'=>request('maxshares'),  
          'status'=>request('status'),
          'user_id'=>Auth::user()->id
         ]);

            $shares=Shares::all();

          

            return view('shares.show',compact('shares'));



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
