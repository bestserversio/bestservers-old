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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();

            // General
            $table->string('name', 128);
            $table->string('url', 128)
                ->unique();
            $table->boolean('has_banner')
                ->default(false);

            // HTML 5
            $table->boolean('html5_supported')
                ->default(false);
            $table->boolean('html5_external')
                ->default(false);
            $table->string('html5_url', 256)
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
