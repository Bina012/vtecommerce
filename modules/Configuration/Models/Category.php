<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Models\Product;

class Category extends Model
{
   use SoftDeletes;
   protected $table = 'categories';

   protected $fillable =[
    'title',
    'slug',
    'description',
    'image_path',
   ];

   protected $hidden = ['deleted_at','created_at','updated_at'];

   public function subcategory()
    {
      return $this->hasMany(SubCategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
