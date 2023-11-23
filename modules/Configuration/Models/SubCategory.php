<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
   use SoftDeletes;
   protected $table = 'subcategories';

   protected $fillable =[
    'title',
    'category_id',
    'description',
    'image_path',
   ];

   protected $hidden = ['deleted_at','created_at','updated_at'];

   public function category()
   {
       return $this->belongsTo(Category::class,'category_id');
   }
  
}
