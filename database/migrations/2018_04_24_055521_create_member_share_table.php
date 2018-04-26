<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberShareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_share', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->float('amount');
            $table->integer('No_shares');
            $table->dateTime('share_date');
            $table->integer('user_id');
           
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
        Schema::dropIfExists('member_share');
    }
}
