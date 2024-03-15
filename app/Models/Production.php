<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
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
    public function feedType()
    {
        return $this->belongsTo(FeedType::class, 'feed_type_id');
    }
    protected function cycleTimeTotal(): Attribute
    {
        $from = Carbon::createFromFormat('h:i:s A', $this->attributes['runtime_start']);
        $to = Carbon::createFromFormat('h:i:s A', $this->attributes['runtime_end']);
    
        $diff_in_hours = $to->floatDiffInHours($from);

        return Attribute::make(
            get: fn () => $diff_in_hours ?? 0,
        );
    }
    protected function dtHour(): Attribute
    {
        $from = Carbon::createFromFormat('h:i:s A', $this->attributes['downtime_start']);
        $to = Carbon::createFromFormat('h:i:s A', $this->attributes['downtime_end']);
        $diff_in_hours = $to->floatDiffInHours($from);
        return Attribute::make(
            get: fn () => $diff_in_hours ?? 0,
        );
    }
    protected function tonsPerHour(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->attributes['tons_produced'] / $this->cycle_time_total ) ?? 0,
        );
    }
}
