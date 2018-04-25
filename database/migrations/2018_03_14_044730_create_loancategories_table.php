<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoancategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loancategories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('category_name');
            $table->float('interest_rate');
               $table->integer('default_duration');
               $table->string('status');
               $table->string('category_code');
               $table->float('repayment_penalty');
               $table->integer('grace_period');
               $table->float('min_amount');
              $table->float('max_amount');
              $table->date('created_at');
              

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loancategories');
    }
}
