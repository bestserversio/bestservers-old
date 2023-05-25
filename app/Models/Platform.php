<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $table = 'platforms';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'engine_id',
        'name',
        'name_short',
        'description',
        'url',
        'has_banner',
        'html5_supported',
        'html5_external',
        'html5_url'
    ];
}
