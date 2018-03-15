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
            $table->string('categoryName');
            $table->float('interestRate');
               $table->integer('defaultDuration');
               $table->string('status');
               $table->string('categoryCode');
               $table->float('repaymentPenalt');
               $table->integer('gracePeriod');
               $table->float('minAmount');
              $table->float('maxAmount');
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
        Schema::dropIfExists('loancategories');
    }
}
