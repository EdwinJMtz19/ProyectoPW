<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('team_id');
            $table->string('event_id');
            $table->string('project_id')->nullable();
            $table->string('registered_by');
            $table->timestamp('registered_at')->useCurrent();
            $table->unique(['team_id', 'event_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
