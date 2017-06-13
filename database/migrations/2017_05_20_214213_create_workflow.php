<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('it_category')->unsigned();
            $table->string('comment')->nullable();
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
        Schema::drop('workflow');
    }
}
