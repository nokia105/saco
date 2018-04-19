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


          view()->composer('loans.template',function($view){

                  $id=request()->segment(2);
         $view->with('member',Member::find($id));
        
            $view->with('no_loans',Member::find($id)->loanlist->count());
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
