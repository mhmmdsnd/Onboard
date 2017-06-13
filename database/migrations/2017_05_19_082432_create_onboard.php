<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnboard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onboard', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->integer('company_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->date('joindate');
            $table->integer('workplace_id')->unsigned();
            $table->string('email');
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
        Schema::drop('onboard');
    }
}
