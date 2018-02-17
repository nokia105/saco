<?php

namespace App;



class Member extends Model
{
    //

    public function user(){

    	return $this->belongsTo(User::class);
    }
}
