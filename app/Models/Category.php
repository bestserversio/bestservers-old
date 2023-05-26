<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'platform_id',
        'parent_id',
        'name',
        'name_short',
        'url',
        'map_prefix',
        'description'
    ];
}
