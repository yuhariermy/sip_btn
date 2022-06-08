<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsOnForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('create_request_forms', function (Blueprint $table) {
            $table->text('detail_request')->after('attachment')->nullable();
            $table->text('detail_access')->after('detail_request')->nullable();
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
            $table->dropColumn(['detail_request','detail_access']);
        });
    }
}
