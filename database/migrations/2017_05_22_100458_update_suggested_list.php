<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSuggestedList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suggested_list', function (Blueprint $table) {
            $table->foreign('holding_id')->references('id')->on('holding');
            $table->foreign('company_id')->references('id')->on('company');
            $table->foreign('division_id')->references('id')->on('division');
            $table->foreign('grade_id')->references('id')->on('grade');
            $table->foreign('item_id')->references('id')->on('item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suggested_list', function (Blueprint $table) {
            $table->dropForeign('suggested_list_holding_id_foreign');
            $table->dropForeign('suggested_list_company_id_foreign');
            $table->dropForeign('suggested_list_division_id_foreign');
            $table->dropForeign('suggested_list_grade_id_foreign');
            $table->dropForeign('suggested_list_item_id_foreign');
        });
    }
}
