<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWorkflow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workflow', function (Blueprint $table) {
            $table->foreign('request_id')->references('id')->on('request');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('it_category')->references('id')->on('itcategory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workflow', function (Blueprint $table) {
            $table->dropForeign('workflow_request_id_foreign');
            $table->dropForeign('workflow_user_id_foreign');
            $table->dropForeign('workflow_itcategory_foreign');
        });
    }
}
