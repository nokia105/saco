<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('loanInssue_date');
            $table->integer('inssued_by');
            $table->string('loan_status');
            $table->integer('loancategory_id');
            $table->integer('member_id');
            $table->integer('duration');
            $table->integer('interestmethod_id');
            $table->float('interest');
            $table->double('principle',30);
            $table->date('repayment_date');
            $table->integer('no_of_installments');
            $table->float('mounthlyrepayment_amount',30);
            $table->float('mounthlyrepayment_principle',30);
            $table->float('mounthlyrepayment_interest',30);
            $table->string('board_status')->nullable();  //newloan
            $table->string('board_reason')->nullable();  //newloan
            $table->date('board_date')->nullable();      //newloan
            $table->integer('board_person')->nullable();   //newloan
            $table->string('firstprocessed_status')->nullable(); //changed->firstprocessed_reason
            $table->string('firstprocessed_reason')->nullable();  
            $table->date('firstprocessed_date')->nullable();
            $table->integer('firstprocessed_person')->nullable();
            $table->string('chair_status')->nullable();
            $table->string('chair_reason')->nullable();
            $table->date('chair_date')->nullable();
            $table->integer('chair_person')->nullable();
            $table->integer('insurance_id'); //manually added

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
