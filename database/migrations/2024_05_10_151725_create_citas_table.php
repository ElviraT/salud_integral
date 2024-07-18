<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('color')->nullable();
            $table->unsignedBigInteger('id_day');
            $table->time('startime');
            $table->time('endtime');

            $table->unsignedBigInteger('id_medical');
            $table->unsignedBigInteger('id_patient');
            $table->unsignedBigInteger('id_type');
            $table->unsignedBigInteger('id_status');
            $table->string('n_seguro')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('id_day')->references('id')->on('days');
            $table->foreign('id_medical')->references('id')->on('medicals');
            $table->foreign('id_patient')->references('id')->on('patients');
            $table->foreign('id_type')->references('id')->on('appointment_types');
            $table->foreign('id_status')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};