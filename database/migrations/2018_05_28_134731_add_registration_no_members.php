<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegistrationNoMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()


    {
        //


         Schema::table('members', function($table) {
        $table->string('registration_no')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
