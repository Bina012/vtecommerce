<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
   use SoftDeletes;
   protected $table = 'product_galleries';

   protected $fillable =[
    'product_id',
    'image_path',
   ];

   protected $hidden = ['deleted_at','created_at','updated_at'];

    public function product(){
        return $this->belongsTo('Modules\Product\Models\Product','product_id');
    }
}
