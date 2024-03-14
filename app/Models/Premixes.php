<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premixes extends Model
{
    use HasFactory;

    protected $fillable = [
        'feed_type_id',
        'beginning', 
        'created_at',
        'active_status'
    ];
}
