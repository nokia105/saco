<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loanschedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->integer('month');
            $table->float('monthprinciple',20);
            $table->float('monthinterest',20);
            $table->string('status')->nullable();
            $table->date('duedate');
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
        Schema::dropIfExists('loanschedules');
    }
}
