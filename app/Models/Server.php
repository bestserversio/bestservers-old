<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $table = 'servers';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'owner_id',
        'platform_id',
        'category_id',
        'name',
        'description',
        'url',
        'rules',
        'has_banner',
        'has_avatar',
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
        'social_website',
        'social_steam',
        'social_twitter',
        'social_youtube',
        'social_facebook',
        'social_tiktok',
        'social_instagram',
        'social_github'
    ];
}
