<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsKirimToCreateRequestFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('create_request_forms', function (Blueprint $table) {
            $table->string('is_kirim')->after('ttd_qa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('create_request_forms', function (Blueprint $table) {
            $table->dropColumn('is_kirim');
        });
    }
}
