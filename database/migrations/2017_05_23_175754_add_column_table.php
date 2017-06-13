<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->after('name');
            $table->foreign('role_id')->references('id')->on('role');
        });

        Schema::table('division', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->after('name');
            $table->foreign('role_id')->references('id')->on('role');
        });

        Schema::table('itcategory', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->after('name');
            $table->integer('division_id')->unsigned()->after('role_id');
            $table->foreign('role_id')->references('id')->on('role');
            $table->foreign('division_id')->references('id')->on('division');
        });
        Schema::table('itemcategory', function (Blueprint $table) {
            $table->integer('division_id')->unsigned()->after('name');
            $table->foreign('division_id')->references('id')->on('division');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropForeign('company_role_id_role_foreign');
        });

        Schema::table('division', function (Blueprint $table) {
            $table->dropForeign('division_role_id_role_foreign');
        });

        Schema::table('itcategory', function (Blueprint $table) {
            $table->dropForeign('itcategory_role_id_role_foreign');
            $table->dropForeign('itcategory_division_id_division_foreign');
        });

        Schema::table('itemcategory', function (Blueprint $table) {
            $table->dropForeign('itemcategory_division_id_division_foreign');
        });
    }
}
