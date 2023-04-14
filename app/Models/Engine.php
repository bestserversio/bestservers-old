<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    use HasFactory;

    protected $table = 'engines';
    protected $incrementing = true;
    protected $timestamps = false;

    protected $fillable = [
        'name',
        'is_discord',
        'is_a2s'
    ];
}
