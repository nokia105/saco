<?php

namespace App;



class Shares extends Model
{
    //

    public function user(){

    	return $this->belongsTo(User::class);
    }
}
