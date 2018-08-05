<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivableaccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivableaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id')->nullable();
            $table->integer('memberaccount_id')->nullable();
            $table->integer('mainaccount_id')->nullable();
            $table->float('dr',40)->nullable();
            $table->float('cr',40)->nullable();
            $table->string('description');
            $table->date('date'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receivableaccounts');
    }
}
