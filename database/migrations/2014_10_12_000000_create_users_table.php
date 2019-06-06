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
            $table->increments('user_id');
            $table->string('email',100)->unique();
            $table->string('password');
            $table->string('company',255);
            $table->string('title_id',3);
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('address',255);
            $table->string('city',100);
            $table->string('state_id',2);
            $table->string('country_id',3);
            $table->string('postal_code',10);
            $table->string('tel',20);
            $table->boolean('active');
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
        Schema::dropIfExists('users');
    }
}
