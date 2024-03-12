<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function feedType()
    {
        return $this->belongsTo(FeedType::class, 'feed_type_id');
    }
    public function totalBatch()
    {
        $prev = Ingredient::whereDate('date', date('Y-m-d', strtotime('-1 day', strtotime($this->attributes['date']))))->where('material_id', $this->attributes['material_id'])->where('feed_type_id', $this->attributes['feed_type_id'])->where('active_status', '1')->first();
        if ($prev) $prev_t_batch = $prev->totalBatch();
        else $prev_t_batch = 0;
        return $this->attributes['batch'] + $prev_t_batch;
    }
    public function usage()
    {
        $standard = $this->attributes['standard'];
        $batch =    $this->attributes['batch'];
        $adjustment = $this->attributes['adjustment'];
        return $standard * $batch + $adjustment;
    }

}
