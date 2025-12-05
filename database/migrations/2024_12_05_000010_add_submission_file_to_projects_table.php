<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('submission_file_path')->nullable()->after('demo_url');
            $table->string('submission_file_name')->nullable()->after('submission_file_path');
            $table->timestamp('submitted_at')->nullable()->after('submission_file_name');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['submission_file_path', 'submission_file_name', 'submitted_at']);
        });
    }
};
