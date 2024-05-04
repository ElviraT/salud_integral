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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idSex');
            $table->unsignedBigInteger('idStatus');
            $table->unsignedBigInteger('idMaritalState');
            $table->unsignedBigInteger('idCountry');
            $table->unsignedBigInteger('idState');
            $table->unsignedBigInteger('idCity');
            $table->unsignedBigInteger('idMunicipality');
            $table->unsignedBigInteger('idParish');
            $table->date('brithday');
            $table->string('register')->unique();
            $table->string('ncolegio')->unique();
            $table->timestamps();

            $table->foreign('idStatus')->references('id')->on('statuses');
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idSex')->references('id')->on('sexes');
            $table->foreign('idMaritalState')->references('id')->on('marital_statuses');
            $table->foreign('idCountry')->references('id')->on('countries');
            $table->foreign('idState')->references('id')->on('states');
            $table->foreign('idCity')->references('id')->on('cities');
            $table->foreign('idMunicipality')->references('id')->on('municipalities');
            $table->foreign('idParish')->references('id')->on('parishes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
