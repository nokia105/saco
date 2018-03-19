<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('loan', function (Blueprint $table) {
            $table->increments('Loan_Id');
            $table->date('Loan_Issue_Date');
            $table->integer('Issued_By');
            $table->string('Loan_Status');
            $table->integer('fk_loan_CategoryId');
            $table->integer('fk_loan_MemberId');
            $table->integer('Duration');
            $table->float('Loan_Amount');
            $table->date('Repayment_Date');
            $table->integer('Number_of_Installments');
            $table->float('Monthly_Repayment_Amount');
            $table->float('Monthly_Repayment _Principal');
            $table->float('Monthly_Repayment _Interest');
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
        //
    }
}
