<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
   use SoftDeletes;
   protected $table = 'products';

   protected $fillable =[
    'category_id',
    'title',
    'description',
    'short_description',
    'manufacture_name',
    'manufacture_brand',
    'stocks',
    'price',
    'discount',
    'color',
    'size',
    'status',
    'visibility',
   ];

   protected $hidden = ['deleted_at','created_at','updated_at'];

    public function category(){
        return $this->belongsTo('Modules\Configuration\Models\Category','category_id');
    }

    public function images(){
        return $this->hasMany(ProductGallery::class);
    }
}
