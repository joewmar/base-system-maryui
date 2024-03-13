<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeeklyOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'date',
        'no_of_working',
        'price_per_kgs',
        'inv_cost',
        'kgs_per_bag',
        'deliveries_today',
        'standard_days',
        'active_status',
    ];


    protected function deliveriesTodate(): Attribute
    {
        $prev_del_todate = 0;
        $prev = parent::whereDate('date', date('Y-m-d', strtotime('-1 day', strtotime($this->attributes['date']))))->where('material_id', $this->attributes['material_id'])->where('active_status', '1')->first();
        if ($prev) $prev_del_todate = $prev->deliveries_todate;
        $del_today = $this->attributes['deliveries_today'];
        $total = $del_today + $prev_del_todate;
        return Attribute::make(
            get: fn () => $total,
        );
    }
    protected function usageToday(): Attribute
    {
        $grandTotals = Ingredient::grandTotal($this->attributes['material_id']);
        return Attribute::make(
            get: fn () => $grandTotals,
        );
    }
    protected function usageTodate(): Attribute
    {
        $prev_usage_todate = 0;
        $prev = parent::whereDate('date', date('Y-m-d', strtotime('-1 day', strtotime($this->attributes['date']))))->where('material_id', $this->attributes['material_id'])->where('active_status', '1')->first();
        if ($prev) $prev_usage_todate = $prev->deliveries_todate;
        $del_today = $this->attributes['deliveries_today'];
        return Attribute::make(
            get: fn () => $del_today + $prev_usage_todate,
        );
    }
    protected function beginInv(): Attribute
    {
        $prev_end_inv = 0;
        $prev = parent::whereDate('date', date('Y-m-d', strtotime('-1 day', strtotime($this->attributes['date']))))->where('material_id', $this->attributes['material_id'])->where('active_status', '1')->first();
        if ($prev) $prev_end_inv = $prev->end_inv;
        return Attribute::make(
            get: fn () =>  $prev_end_inv,
        );
    }
    protected function endInv(): Attribute
    {
        $begin_inv = $this->attributes['price_per_kgs'] ?? 0;
        $del_today = $this->attributes['deliveries_today'] ?? 0;
        $usage_today = $this->attributes['usage_today'] ?? 0;
        return Attribute::make(
            get: fn () => $begin_inv + $del_today + $usage_today,
        );
    }
    protected function endInvBags(): Attribute
    {
        $price_per_kgs = $this->attributes['price_per_kgs'] ?? 0;
        $end_inv = $this->attributes['end_inv'] ?? 0;
        return Attribute::make(
            get: fn () => ($end_inv / $price_per_kgs) ?? 0,
        );
    }
    // Relationships
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    public function ingridients()
    {
        return $this->hasMany(Ingredient::class, 'material_id', 'material_id');
    }


}
