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
            $table->string('password',300);
            $table->string('email',100)->unique();
            $table->string('phone',30)->nullable();
            $table->string('bank_name',30)->nullable();
            $table->string('account_number',30)->nullable();
            $table->string('nextkin_name',30)->nullable();
            $table->string('nextkin_relationship',30);
            $table->date('joining_date',30);
            $table->string('status')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable(); 
            $table->string('couple_names')->nullable();
            $table->char('box_number')->nullable();
            $table->char('street_name')->nullable();
            $table->char('house_no')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
}
