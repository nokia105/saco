<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanaccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loanaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('memberaccount_id')->nullable();
            $table->integer('mainaccount_id')->nullable();
            $table->float('dr',40)->nullable();
            $table->float('cr',40)->nullable();
            $table->string('description');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loanaccounts');
    }
}
