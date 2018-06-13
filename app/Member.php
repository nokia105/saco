<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;




class Member extends Authenticatable
{
    //

     use Notifiable;

    use HasRoles;

     protected $primaryKey = 'member_id';

     protected $dates = ['joining_date'];

     protected $guard = 'member';

     protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     

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

         return $this->hasMany(Loan::class,'member_id')->orderBy('repayment_date','ASC');
       }

       public function no_shares(){

         return $this->hasMany(Member_share::class,'member_id');
       }

       public function savingamount(){

         return $this->hasMany(Membersaving::class,'member_id');
       }




}
