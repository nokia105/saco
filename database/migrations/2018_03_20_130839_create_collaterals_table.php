<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollateralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaterals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('colateral_name');
            $table->string('colateral_type');
            $table->float('colateral_value',20);
            $table->date('colateralevalution_date');
            $table->integer('member_id');
            $table->integer('user_id');
            $table->date('date_created');
           
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collaterals');
    }
}
