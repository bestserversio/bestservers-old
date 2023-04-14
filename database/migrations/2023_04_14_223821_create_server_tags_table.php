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
        Schema::create('server_tags', function (Blueprint $table) {
            $table->foreignId('server_id')
                ->constrained('servers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('tag_name');
            $table->foreign('tag_name')
                ->references('name')
                ->on('tags')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            // Primary Keys
            $table->primary(['server_id', 'tag_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_tags');
    }
};
