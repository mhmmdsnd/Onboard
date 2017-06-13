<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSuggestedList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suggested_list', function (Blueprint $table) {
            $table->integer('it_category')->unsigned()->after('item_id')->comment('add-on field POC');
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
        Schema::table('suggested_list', function (Blueprint $table) {
            $table->dropForeign('suggested_list_it_category_foreign');
        });
    }
}
