<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayableaccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payableaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_share_id')->nullable();
            $table->integer('membersaving_id')->nullable();
            $table->float('dr',40)->nullable();
            $table->float('cr',40)->nullable();
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
        Schema::dropIfExists('payableaccounts');
    }
}
