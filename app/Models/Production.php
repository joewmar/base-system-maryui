<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'feed_type_id',
        'runtime_start',
        'runtime_end',
        'tons_produced',
        'target_tons_hour',
        'prod_target_tons',
        'quality_assurance_id',
        'downtime_id',
        'downtime_start',
        'downtime_end',
        'total_hours_operated',
        'no_of_manpower',
        'remarks',
        'active_status',
    ];
}
