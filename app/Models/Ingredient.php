<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'feed_type_id',
        'standard',
        'batch',
        'adjustment',
        'date',
        'active_status',
    ];
}
