<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeginToDetailAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_accesses', function (Blueprint $table) {
            $table->dropForeign(['access_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_accesses', function (Blueprint $table) {
            $table->foreign('access_type_id')
                ->references('id')
                ->on('type_acesses')
                ->onDelete('cascade');
        });
    }
}
