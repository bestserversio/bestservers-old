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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // General
            $table->string('name', 128);
            $table->text('description')
                ->nullable();
            $table->string('url', 128)
                ->unique();
            $table->text('rules')
                ->nullable();

            $table->boolean('has_banner')
                ->default(false);

            // Dynamic
            $table->integer('players')
                ->default(0);
            $table->integer('max_players')
                ->default(0);
            $table->string('map', 64)
                ->nullable();
            $table->dateTime('last_scanned')
                ->nullable();
            $table->dateTime('last_stat')
                ->nullable();

            // Network
            $table->ipAddress('ipv4')
                ->nullable();
            $table->ipAddress('ipv6')
                ->nullable();
            $table->smallInteger('port', false, true)
                ->nullable();
            $table->string('host_name', 256)
                ->nullable();

            // Location
            $table->decimal('location_lat')
                ->nullable();
            $table->decimal('location_lon')
                ->nullable();

            // Social Media
            $table->string('social_steam', 128)
                ->nullable();
            $table->string('social_twitter', 128)
                ->nullable();
            $table->string('social_youtube', 128)
                ->nullable();
            $table->string('social_facebook', 128)
                ->nullable();
            $table->string('social_tiktok', 128)
                ->nullable();
            $table->string('social_instagram', 128)
                ->nullable();
            $table->string('social_github', 128)
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
