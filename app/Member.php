<?php

namespace App;



class Member extends Model
{
    //

     protected $primaryKey = 'member_id';

    public function user(){

    	return $this->belongsTo(User::class);
    }

       public function collateral(){


       	  return $this->hasMany(Collateral::class,'member_id');
       }


          public function loans(){

     	return $this->belongsToMany(Loan::class,'loan_guarantor','loan_id','guarator_id');
     }
}
