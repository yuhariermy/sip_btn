<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_requests', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('create_request_form_id')->nullable();
            $table->foreign('create_request_form_id')->references('id')->on('create_request_forms')->onDelete('cascade');
            $table->unsignedInteger('connection_type_id')->nullable();
            $table->foreign('connection_type_id')->references('id')->on('type_connections')->onDelete('cascade');
            $table->string('source_name', 100)->nullable();
            $table->string('source_ip_address', 100)->nullable();
            $table->string('destination_name', 100)->nullable();
            $table->string('destination_ip_address', 100)->nullable();
            $table->string('tcp', 1)->nullable()->default('N');
            $table->string('udp', 1)->nullable()->default('N');
            $table->string('port', 50)->nullable();
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
        Schema::dropIfExists('detail_requests');
    }
}
