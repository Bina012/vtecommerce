<?php

namespace Modules\Product\Repositories;

use App\Repositories\Repository;
use Modules\Product\Models\ProductGallery;

class ProductGalleryRepository extends Repository{

    public function __construct(ProductGallery $productGallery){
        $this->modelClass = $productGallery;
    }
}