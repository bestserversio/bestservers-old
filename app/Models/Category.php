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

    public static $columns = [
        'id',
        'platform_id',
        'name',
        'url',
        'description'
    ];

    protected $fillable = [
        'platform_id',
        'name',
        'url',
        'description'
    ];
}
