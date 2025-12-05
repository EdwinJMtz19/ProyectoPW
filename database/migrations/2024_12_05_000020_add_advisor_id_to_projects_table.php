<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Agregar columna advisor_id si no existe
            if (!Schema::hasColumn('projects', 'advisor_id')) {
                $table->uuid('advisor_id')->nullable()->after('event_id');
                $table->foreign('advisor_id')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'advisor_id')) {
                $table->dropForeign(['advisor_id']);
                $table->dropColumn('advisor_id');
            }
        });
    }
};
