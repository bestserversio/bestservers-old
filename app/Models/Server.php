<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $table = 'servers';
    protected $incrementing = true;
    protected $timestamps = true;

    protected $fillable = [
        'owner_id',
        'platform_id',
        'category_id',
        'name',
        'description',
        'url',
        'rules',
        'has_banner',
        'players',
        'max_players',
        'map',
        'last_scanned',
        'last_stat',
        'ipv4',
        'ipv6',
        'port',
        'host_name',
        'location_lat',
        'location_lon',
        'social_steam',
        'social_twitter',
        'social_youtube',
        'social_facebook',
        'social_tiktok',
        'social_instagram',
        'social_github'
    ];
}
