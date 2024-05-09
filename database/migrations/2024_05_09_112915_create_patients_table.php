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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_marital');
            $table->string('ocupation');
            $table->timestamps();

            $table->foreign('id_status')->references('id')->on('statuses');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_marital')->references('id')->on('marital_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
