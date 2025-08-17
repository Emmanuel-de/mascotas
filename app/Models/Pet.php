<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'breed',
        'age',
        'price',
        'condition',
        'available',
        'description',
        'image',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function saleItems()
    {
        return $this->morphMany(SaleItem::class, 'item');
    }
}