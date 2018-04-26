<?php

namespace App;



class Loan extends Model
{
    //

    public function user(){

    	return $this->belongsTo(User::class);
    }


     public function guarantor(){

     	return $this->belongsToMany(Member::class,'loan_guarantor','loan_id','guarator_id')->withTimestamps();
     }



       public function collaterals(){

       	return $this->belongsToMany(Collateral::class)->withTimestamps();
       }
       public function loan_fees(){

        return $this->belongsToMany(Feescategory::class)->withTimestamps();
       }

      public function loancategory(){

         return $this->belongsTo(loancategory::class);
       }



}
