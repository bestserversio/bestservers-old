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
        Schema::create('engines', function (Blueprint $table) {
            $table->id();

            $table->string('name', 128);

            $table->boolean('is_discord')
                ->default(false);
            $table->boolean('is_a2s')
                ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engines');
    }
};
