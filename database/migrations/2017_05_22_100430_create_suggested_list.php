<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestedList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggested_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('holding_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->integer('item_id')->unsigned();
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
        Schema::drop('suggested_list');
    }
}
