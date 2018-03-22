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
            $table->date('loanInssue_date');
            $table->integer('inssued_by');
            $table->string('loan_status');
            $table->integer('loancategory_id');
            $table->integer('member_id');
            $table->integer('duration');
            $table->float('loan_amount',10);
            $table->date('repatment_date');
            $table->integer('no_of_installments');
            $table->float('mounthlyrepayment_amount',20);
            $table->float('mounthlyrepayment_principle',20);
            $table->float('mounthlyrepayment_interest',20);
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
        Schema::dropIfExists('loans');
    }
}
