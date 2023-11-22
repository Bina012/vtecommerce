<?php

namespace Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
