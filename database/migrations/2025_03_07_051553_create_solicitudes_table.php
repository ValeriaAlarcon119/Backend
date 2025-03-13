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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidato_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_estudio_id')->constrained()->onDelete('cascade');
            $table->enum('estado', ['pendiente', 'en_proceso', 'completado']);
            $table->timestamp('fecha_solicitud')->nullable();
            $table->timestamp('fecha_completado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
