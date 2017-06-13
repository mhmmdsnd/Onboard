<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOnboard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onboard',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('company');
            $table->foreign('division_id')->references('id')->on('division');
            $table->foreign('grade_id')->references('id')->on('grade');
            $table->foreign('workplace_id')->references('wpId')->on('workplace');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('onboard', function (Blueprint $table) {
            $table->dropForeign('onboard_company_id_foreign');
            $table->dropForeign('onboard_division_id_foreign');
            $table->dropForeign('onboard_grade_id_foreign');
            $table->dropForeign('onboard_wpId_foreign');
        });
    }
}
