<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'item_type',
        'item_id',
        'quantity',
        'price',
        'subtotal',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function item()
    {
        if ($this->item_type === 'product') {
            return $this->belongsTo(Product::class, 'item_id');
        } elseif ($this->item_type === 'pet') {
            return $this->belongsTo(Pet::class, 'item_id');
        }
        return null;
    }
}