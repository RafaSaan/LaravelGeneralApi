<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'amount',
        'amountWholesale',
        'hasWholesale',
        'imgUrl',
        'statusId'
    ];

    public function getStatusNameAttribute()
    {
        return $this->status->name ?? '';
    }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'statusId', 'id');
    }
}
