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
        Schema::table('users', function (Blueprint $table) {
            $table->string('movil')->after('email')->nullable();
            $table->string('brithday')->after('movil')->nullable();
            $table->string('address')->after('brithday')->nullable();
            $table->unsignedBigInteger('country_id')->after('address')
                ->nullable();
            $table->foreign('country_id')
                ->references('id')
                ->on('countries');
            $table->unsignedBigInteger('state_id')->after('country_id')
                ->nullable();
            $table->foreign('state_id')
                ->references('id')
                ->on('states');
            $table->unsignedBigInteger('city_id')
                ->after('state_id')
                ->nullable();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
