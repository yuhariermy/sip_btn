<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToCreateRequestFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('create_request_forms', function (Blueprint $table) {
            $table->string('attachment')->after('end_date')->nullable();
            $table->string('ttd_requester')->after('attachment')->nullable();
            $table->string('ttd_cmt')->after('ttd_requester')->nullable();
            $table->string('ttd_qa')->after('ttd_cmt')->nullable();
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
            $table->dropColumn(['attachment','ttd_requester','ttd_cmt','ttd_qa']);
        });
    }
}
