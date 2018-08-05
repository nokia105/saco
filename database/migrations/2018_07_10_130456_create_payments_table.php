<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('narration');
            $table->integer('loan_id')->nullable();
            $table->float('amount',40);
            $table->integer('membersaving_id')->nullable();
            $table->integer('member_share_id')->nullable();
            $table->string('payment_type'); 
            $table->integer('paid_by')->nullable();
            $table->string('state');
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
        Schema::dropIfExists('payments');
    }
}
