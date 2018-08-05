<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journalentries', function(Blueprint $table) {
            $table->increments('id');
            $table->float('dr',40);
            $table->float('cr',40);
            $table->integer('memberaccount_id')->nullable();
            $table->integer('mainaccount_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->string('service_type')->nullable();
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
        Schema::dropIfExists('journalentries');
    }
}
