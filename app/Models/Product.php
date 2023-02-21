<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Cartable;


class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    // public function inventory()
    // {
    //     return $this->hasOne(Inventory::class);
    // }
    public function getUnitPriceAttribute($value)
    {
        return number_format($value, 2);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('price', 'quantity');
    }
}