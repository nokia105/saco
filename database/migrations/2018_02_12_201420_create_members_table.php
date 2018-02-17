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
            $table->increments('id');
            $table->char('firstname',30);
            $table->char('middlename',30);
            $table->char('lastname',30);
            $table->string('password',30);
            $table->string('email',100);
            $table->string('phone',30);
            $table->string('bankname',30);
            $table->string('accountnumber',30);
            $table->string('nextkinname',30);
            $table->string('nextkinrelationship',30);
            $table->date('joiningdate',30);
            $table->integer('status');
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
        Schema::dropIfExists('members');
    }
}
