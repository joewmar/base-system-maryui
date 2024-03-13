<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    protected function usage(): Attribute
    {
        $standard = $this->attributes['standard'];
        $batch =    $this->attributes['batch'];
        $adjustment = $this->attributes['adjustment'];
        return Attribute::make(
            get: fn () => $standard * $batch + $adjustment,
        );
    }
    protected function totalBatch(): Attribute
    {
        $prev = parent::whereDate('date', date('Y-m-d', strtotime('-1 day', strtotime($this->attributes['date']))))->where('material_id', $this->attributes['material_id'])->where('feed_type_id', $this->attributes['feed_type_id'])->where('active_status', '1')->first();
        if ($prev) $prev_t_batch = $prev->totalBatch();
        else $prev_t_batch = 0;
        return Attribute::make(
            get: fn () => $this->attributes['batch'] + $prev_t_batch,
        );
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
    public function feedType()
    {
        return $this->belongsTo(FeedType::class, 'feed_type_id');
    }
    public function totalUsage($farmID)
    {
        $total = 0;
        $ingredients = parent::where('material_id', $this->attributes['material_id'])->where('active_status', '1')->get();
        foreach ($ingredients as $ingredient){
            if($farmID == $ingredient->feedType->farm_id) $total += $ingredient->usage;
        }
        return $total;
    }
    public static function grandTotal($materialID)
    {
        $total = 0;
        $feed_types =  parent::where('material_id', $materialID)->where('active_status', '1')->get();
        foreach ($feed_types as $feed_type){
            $total += $feed_type->usage;
        }
        return $total;
    }
}
