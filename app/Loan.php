<?php

namespace App;



class Loan extends Model
{
    //

    public function user(){

    	return $this->belongsTo(User::class);
    }
}
