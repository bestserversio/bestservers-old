<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    use HasFactory;

    protected $table = 'engines';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'name_short',
        'description',
        'is_discord',
        'is_a2s'
    ];
}
