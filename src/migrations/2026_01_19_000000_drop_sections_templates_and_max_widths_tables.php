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
        Schema::dropIfExists('sections_templates');
        Schema::dropIfExists('sections_max_widths');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('sections_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('sections_max_widths', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('class')->nullable();
            $table->timestamps();
        });
    }
};
