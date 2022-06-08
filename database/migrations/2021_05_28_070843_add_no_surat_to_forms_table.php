<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoSuratToFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('create_request_forms', function (Blueprint $table) {
            $table->string('no_surat')->after('id')->nullable();
            $table->unsignedInteger('purpose_id')->nullable()->after('no_pcr');
            $table->foreign('purpose_id')->references('id')->on('purposes')->onDelete('cascade');
            $table->string('purpose_other')->after('purpose_id')->nullable();
            $table->unsignedInteger('location_id')->nullable()->after('purpose_other');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->dropColumn('purpose');
            $table->dropColumn('location');
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
            $table->dropForeign(['purpose_id']);
            $table->dropForeign(['location_id']);
            $table->dropColumn(['purpose_id','location_id','no_surat','purpose_other']);
            $table->string('purpose', 150)->nullable();
            $table->string('location', 150)->nullable();
        });
    }
}
