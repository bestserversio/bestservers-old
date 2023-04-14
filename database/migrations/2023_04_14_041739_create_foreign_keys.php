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
        Schema::table('servers', function (BluePrint $table) {
            $table->foreignId('owner_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('platform_id')
                ->constrained('platforms')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::table('platforms', function (BluePrint $table) {
            $table->foreignId('engine_id')
                ->nullable()
                ->constrained('engines')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::table('categories', function (BluePrint $table) {
            $table->foreignId('platform_id')
                ->constrained('platforms')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foreign_keys');
    }
};
