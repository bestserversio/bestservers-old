<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerTag extends Model
{
    use HasFactory;

    protected $table = 'server_tags';
    protected $primaryKey = ['server_id', 'tag_name'];
    public $incrementing = false;

    protected $fillable = [
        'server_id',
        'tag_name'
    ];
}
