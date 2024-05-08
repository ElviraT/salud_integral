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
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_speciality');
            $table->string('register')->unique();
            $table->string('ncolegio')->unique();
            $table->timestamps();

            $table->foreign('id_status')->references('id')->on('statuses');
            $table->foreign('id_speciality')->references('id')->on('specialities');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicals');
    }
};
