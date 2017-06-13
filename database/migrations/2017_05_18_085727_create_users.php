<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
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
            $table->string('name',25);
            $table->string('lastname',25);
            $table->string('firstname',25);
            $table->string('email',120);
            $table->string('password');
            $table->rememberToken();
            $table->string('created_by',5)->nullable();
            $table->string('updated_by',5)->nullable();
            $table->timestamp('updated_at')->nullable()->default(NULL, DB::raw('ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
