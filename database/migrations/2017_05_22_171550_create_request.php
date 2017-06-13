<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('onboard_id')->unsigned();
            $table->timestamp('request_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('request_by')->unsigned();
            $table->string('ticket',5);
            $table->dateTime('delivery_date')->nullable();
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
        Schema::drop('request');
    }
}
