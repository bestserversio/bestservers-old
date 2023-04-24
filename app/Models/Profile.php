<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $primaryKey = ['user_id'];
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'about_me',
        'website',
        'social_twitter',
        'social_steam',
        'social_discord',
        'social_instagram'
    ];
}
