<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loancategory;

class LoancategoriesController extends Controller
{
    //

    public function index(){


    	return view('LoanCategory.form');
    }


    public function store(){


    	$this->validate(request(),[
        
        'categoryname'=>'required',
        'categorycode'=>'required',
        'Irate'=>'required',
        'duration'=>'required',
        'repaypenaty'=>'required',
        'graceperiod'=>'required',
        'maxAmount'=>'required',
        'minAmount'=>'required'

    	]);


    	 Loancategory::create([
         'categoryName'=>request('categoryname'),
         'interestRate'=>request('categorycode'),
         'defaultDuration'=>request('duration'),
         'status'=>'1',
         'categoryCode'=>request('categorycode'),
         'repaymentPenalt'=>request('repaypenaty'),
         'gracePeriod'=>request('graceperiod'),
         'minAmount'=>request('minAmount'),
         'maxAmount'=>request('maxAmount')

    	 ]);
    }




}
