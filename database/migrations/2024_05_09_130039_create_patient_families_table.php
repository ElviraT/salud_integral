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
        Schema::create('patient_families', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_patient');
            $table->unsignedBigInteger('id_marital');
            $table->unsignedBigInteger('id_gender');
            $table->unsignedBigInteger('id_relation');
            $table->string('name');
            $table->string('last_name');
            $table->string('dni')->nullable();
            $table->string('birthdate');
            $table->timestamps();

            $table->foreign('id_patient')->references('id')->on('patients');
            $table->foreign('id_marital')->references('id')->on('marital_statuses');
            $table->foreign('id_gender')->references('id')->on('sexes');
            $table->foreign('id_relation')->references('id')->on('relationships');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_families');
    }
};
