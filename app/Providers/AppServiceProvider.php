<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Member;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


          view()->composer(['loans.template','member.member_template'],function($view){

         $id=request()->segment(2);
         $view->with('member',Member::find($id));
        $view->with('submitted_loans',Member::find($id)->loanlist->where('loan_status','=','submitted')->count());
        $view->with('no_loans',Member::find($id)->loanlist->where('loan_status','=','paid')->count());
         $view->with('rejected_loans',Member::find($id)->loanlist->where('loan_status','=','rejected')->count());
          $view->with('pending_loans',Member::find($id)->loanlist->where('loan_status','=','pending')->count());
          
        });


        Schema::defaultStringLength(191);



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
