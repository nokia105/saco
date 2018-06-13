<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedloansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recivedloans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->string('action_status')->nullable();
            $table->string('action_reason')->nullable();
            $table->date('action_date')->nullable();
            $table->date('action_startdate')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recivedloans');
    }
}
