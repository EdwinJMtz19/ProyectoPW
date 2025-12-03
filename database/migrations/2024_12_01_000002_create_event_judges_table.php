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
        // Tabla para asignar jueces a eventos
        Schema::create('event_judges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('event_id');
            $table->string('judge_id'); // user_id del juez
            $table->string('status', 20)->default('active'); // active, inactive
            $table->timestamp('assigned_at')->useCurrent();
            $table->string('assigned_by')->nullable(); // quien lo asignó
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Evitar asignar el mismo juez dos veces al mismo evento
            $table->unique(['event_id', 'judge_id']);
            
            // Índices para búsquedas rápidas
            $table->index('event_id');
            $table->index('judge_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_judges');
    }
};
