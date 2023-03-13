<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Cartable;


class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')->withPivot('price', 'quantity');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function specification()
    {
        return $this->hasMany(Specification::class);
    }

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }
}