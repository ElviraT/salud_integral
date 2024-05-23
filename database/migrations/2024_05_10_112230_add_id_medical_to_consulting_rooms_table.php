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
        Schema::table('consulting_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('id_medical')->after('phone');
            $table->integer('max_patient')->after('id_medical');
            $table->foreign('id_medical')->references('id')->on('medicals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consulting_rooms', function (Blueprint $table) {
            //
        });
    }
};
