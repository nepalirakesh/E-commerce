<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Category extends Model
{
    use HasFactory;
    private $descandants = [];
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'status',
        'slug'
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
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
     * @return $parents
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


    public function findDescendants(Category $category)
    {
        $this->descandants[] = $category->id;

        if ($category->children->isNotEmpty()) {
            foreach ($category->children as $child) {
                $this->findDescendants($child);
            }
        }
    }

    public function getDescendants(Category $category)
    {
        $this->findDescendants($category);
        return $this->descandants;
    }

    public static function getRootCategories()
    {
        return Category::whereNull('parent_id')->get();
    }

    public function setCategoryStatus($id)
    {
        $selectedCategory = Category::find($id);
        $products = collect([]);

        if ($selectedCategory->children->isNotEmpty()) {
            $descendants = $selectedCategory->getDescendants($selectedCategory);
            foreach ($descendants as $descendant) {
                $product = Product::where('category_id', $descendant)->get();
                $products = $products->concat($product);
            }
        } else {
            $products = $selectedCategory->products()->get();
        }

        if (count($products) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function getCategoryImage($id)
    {
        $selectedCategory = Category::find($id);

        $products = collect([]);

        if ($selectedCategory->children->isNotEmpty()) {
            $descendants = $selectedCategory->getDescendants($selectedCategory);
            foreach ($descendants as $descendant) {
                $product = Product::where('category_id', $descendant)->get();
                $products = $products->concat($product);
            }
        } else {
            $products = $selectedCategory->products()->get();
        }
    
        if($products->isNotEmpty()){
            $product=$products->random(1)->pluck('image')->toArray();
           
            return $product[0];
        }

    }
}
