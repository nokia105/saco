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
            $table->string('categoryName',50);
            $table->float('interestRate',20,2);
               $table->integer('defaultDuration',10);
               $table->string('status',20);
               $table->string('categoryCode',20);
               $table->float('repaymentPenalt',20,2);
               $table->integer('gracePeriod',10);
               $table->float('minAmount',20);
              $table->float('maxAmount',20);
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
