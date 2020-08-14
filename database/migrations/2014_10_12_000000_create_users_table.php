<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->longText('password');
            $table->string('phone_number', 20);
            $table->string('address', 500);
            $table->enum('gender', ['male', 'female', 'others']);
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();

            #foreign key constraints
            // $table->foreign('group_id')->references('group_id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
