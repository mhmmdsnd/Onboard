<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOnboardItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('onboard_item', function (Blueprint $table) {
            $table->foreign('onboard_id')->references('id')->on('onboard');
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
        Schema::table('onboard_item', function (Blueprint $table) {
            $table->dropForeign('onboard_item_onboard_id_foreign');
            $table->dropForeign('onboard_item_item_id_foreign');
        });
    }
}
