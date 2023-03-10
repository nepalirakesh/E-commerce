<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'front_image', 'back_image', 'side_image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
