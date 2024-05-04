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
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('facebook')->after('company_icon')->nullable();
            $table->string('instagram')->after('facebook')->nullable();
            $table->string('twitter')->after('instagram')->nullable();
            $table->string('address2')->after('address')->nullable();
            $table->string('phone2')->after('address2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            //
        });
    }
};