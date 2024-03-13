<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_name',
        'category',
        'active_status',
    ];
    protected function materialName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => $value,
        );
    }
    protected function category(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => $value,
        );
    }

    public function orders()
    {
        return $this->hasMany(WeeklyOrder::class, 'material_id');
    }
}
