<?php

namespace App;



class Loan extends Model
{
    //

    public function user(){

    	return $this->belongsTo(User::class);
    }


     public function guarantor(){

     	return $this->belongsToMany(Member::class,'loan_guarantor','loan_id','guarator_id');
     }



       public function collaterals(){

       	return $this->belongsToMany(Collateral::class);
       }
}
