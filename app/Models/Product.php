<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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

     // return products with hightest sales
     public static function getTopProducts()
     {
         $top = OrderProduct::select('product_id', DB::raw('COUNT(product_id) as `count`'))->groupBy('product_id')->orderBy('count', 'desc')->limit(1)->get();
         $topProd = collect([]);
 
         foreach ($top as $t) {
             $prod = Product::all()->where('id', '=', $t->product_id);
             $topProd = $topProd->concat($prod);
         }
         return $topProd;
     }
}
