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
        'amount_wholesale',
        'has_wholesale',
        'img_url',
        'status_id'
    ];

    public function getStatusNameAttribute()
    {
        return $this->status->name ?? '';
    }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'status_id', 'id');
    }
}
