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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject'); //ASUNTO
            $table->string('assigned_name'); //NOMBRE ASIGNADO
            $table->string('assigned_due'); //FECHA ASIGNADA
            $table->string('due_date'); //FECHA DE VENCIMIENTO
            $table->text('description'); // DESCRIPCION
            $table->unsignedBigInteger('user_id'); // USUARIO ASIGNADO
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('priority_id'); // PRIORIDAD
            $table->foreign('priority_id')
                ->references('id')
                ->on('priorities');
            $table->unsignedBigInteger('state_id'); // ESTATUS
            $table->foreign('state_id')
                ->references('id')
                ->on('status_tickets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};