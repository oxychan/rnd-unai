<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('telp');
            $table->string('file_name')->nullable();
            $table->unsignedBigInteger('id_type');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_helpdesk')->nullable();
            $table->unsignedBigInteger('id_spv')->nullable();
            $table->unsignedBigInteger('id_worker')->nullable();
            $table->integer('status');
            $table->boolean('is_revised')->default(0);
            $table->boolean('is_spv_approved')->default(0);
            $table->boolean('is_worker_approved')->default(0);
            $table->boolean('is_duplicated')->default(0);
            $table->boolean('is_data_duplicate')->default(0);
            $table->string('revise_note')->nullable();
            $table->string('close_note')->nullable();
            $table->timestamps();

            $table->foreign('id_type')->references('id')->on('request_types');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_helpdesk')->references('id')->on('users')->nullable();
            $table->foreign('id_spv')->references('id')->on('users')->nullable();
            $table->foreign('id_worker')->references('id')->on('users')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
