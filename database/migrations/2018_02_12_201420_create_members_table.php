<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('member_id');
            $table->char('first_name',30);
            $table->char('middle_name',30);
            $table->char('last_name',30);
            /*$table->string('password',30);*/
            $table->string('email',100);
            $table->string('phone',30);
            $table->string('bank_name',30);
            $table->string('account_number',30);
            $table->string('nextkin_name',30);
            $table->string('nextkin_relationship',30);
            $table->date('joining_date',30);
            $table->integer('status')->nullable();
            $table->integer('user_id')->nullable();  
          

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
