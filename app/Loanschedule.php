<?php

namespace App;



class Loanschedule extends Model
{
    //

        public function repayment(){

       return $this->hasMany(Repayment::class);
    }

    public function monthrepayment(){


    	 return $this->belongsToMany(Repayment::class);
    }


      public function loan(){

            return $this->belongsTo(Loan::class);
          }


          public function monthpenaty(){

             return $this->hasOne(Monthpenaty::class);
          }
}


  