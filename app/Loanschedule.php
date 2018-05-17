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
}


  