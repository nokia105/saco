<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membersavings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('saving_code');
            $table->float('amount');
            $table->dateTime('saving_date');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membersavings');
    }
}
