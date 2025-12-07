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
        // Tabla para asignar asesores a eventos
        Schema::create('event_advisors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('event_id');
            $table->string('advisor_id'); // user_id del asesor
            $table->string('status', 20)->default('active'); // active, inactive
            $table->timestamp('assigned_at')->useCurrent();
            $table->string('assigned_by')->nullable(); // quien lo asignó
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Evitar asignar el mismo asesor dos veces al mismo evento
            $table->unique(['event_id', 'advisor_id']);
            
            // Índices para búsquedas rápidas
            $table->index('event_id');
            $table->index('advisor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_advisors');
    }
};
