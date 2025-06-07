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
        Schema::table('participants', function (Blueprint $table) {
            // Drop the existing foreign key constraint first
            $table->dropConstrainedForeignId('event_id');
            // Then add the column back as nullable
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            // Drop the nullable foreign key constraint
            $table->dropConstrainedForeignId('event_id');
            // Add it back as not nullable (original state)
            $table->foreignId('event_id')->constrained()->onDelete('cascade')->change();
        });
    }
};