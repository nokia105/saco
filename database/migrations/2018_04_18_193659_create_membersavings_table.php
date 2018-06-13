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
            $table->float('amount',20);
            $table->date('saving_date');
            $table->integer('user_id');
           
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
