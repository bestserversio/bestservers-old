<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $table = 'follows';
    protected $primaryKey = ['user_id', 'server_id'];
    protected $incrementing = false;
    protected $timestamps = false;

    protected $fillable = [
        'created_at',
        'user_id',
        'server_id'
    ];
}
