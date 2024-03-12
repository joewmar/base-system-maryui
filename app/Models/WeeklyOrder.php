<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'date',
        'price_per_kg',
        'inv_cost',
        'kgs_per_bag',
        'standard_days',
    ];

}
