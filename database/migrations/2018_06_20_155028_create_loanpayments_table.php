<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loanpayments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->float('amount_paid',50);
            $table->date('paid_date');
            $table->integer('paid_by');
            $table->string('mode_payment');
            $table->integer('mode_no');
            $table->timestamps();

             //many od data are redandance and can be solved by referencing voucher id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loanpayments');
    }
}
