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


     public function loanlist(){

         return $this->hasMany(Loan::class,'member_id');
       }

       public function no_shares(){

         return $this->hasMany(Member_share::class,'member_id');
       }

       public function savingamount(){

         return $this->hasMany(Membersaving::class,'member_id');
       }
}
