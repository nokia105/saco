<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->float('amount',30);
            $table->integer('memberaccount_id');
            $table->integer('mainaccount_id');
            $table->string('narration');
            $table->integer('loan_id')->nullable();
            $table->string('status');
            $table->string('mode_payment')->nullable();
            $table->date('date');
            $table->integer('created_by');
            $table->date('approved_date')->nullable();
            $table->integer('approved_by')->nullable();
            $table->date('paid_date')->nullable();
            $table->integer('paid_by')->nullable();
            $table->string('voucher_no');
            $table->string('check_no')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
