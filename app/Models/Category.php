<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'parent_id', 'status', 'slug'
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Display slug instead of id in URL
     * 
     * @return slug
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

   /**
    * Return parent and all parent till root node
    * 
    * @return parents
    */
    public function getParentsAttribute()
    {
        $parents = collect([]);

        $currentParent = $this->parent;

        while (!is_null($currentParent)) {
            $parents->prepend($currentParent);
            $currentParent = $currentParent->parent;
        }
        return $parents;
    }
}
