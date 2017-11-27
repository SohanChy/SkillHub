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
            $table->string('mobile')->unique();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->text('bio')->nullable();
            $table->string('role')->default("student");
            $table->string('password');
            $table->text('address')->nullable();
            $table->text('edu_stat')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('last_login')->nullable();
            $table->string('pro_pic', 100)->nullable()->default(null);
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
