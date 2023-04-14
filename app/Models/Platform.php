<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $table = 'platforms';
    protected $incrementing = true;
    protected $timestamps = false;

    protected $fillable = [
        'engine_id',
        'name',
        'url',
        'has_banner',
        'html5_supported',
        'html5_external',
        'html5_url'
    ];
}
