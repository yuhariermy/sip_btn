<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_accesses', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('create_request_form_id')->nullable();
            $table->foreign('create_request_form_id')->references('id')->on('create_request_forms')->onDelete('cascade');
            $table->unsignedInteger('access_type_id')->nullable();
            $table->foreign('access_type_id')->references('id')->on('type_connections')->onDelete('cascade');
            $table->string('fullname', 100)->nullable();
            $table->string('server_name', 100)->nullable();
            $table->string('db_name', 100)->nullable();
            $table->string('ip_address', 100)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_accesses');
    }
}
