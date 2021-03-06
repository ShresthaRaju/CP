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
            $table->string('name', 30);
            $table->string('email', 100)->unique();
            $table->string('username', 30)->unique();
            $table->string('password', 255);
            $table->text('display_image')->nullable();
            $table->integer('experience')->unsigned()->default(0);
            $table->integer('awards')->unsigned()->default(0);
            $table->string('github', 30)->nullable();
            $table->string('linkedin', 30)->nullable();
            $table->boolean('active')->default(0);
            $table->string('verification_token', 40)->nullable();
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
