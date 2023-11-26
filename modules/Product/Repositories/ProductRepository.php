<?php

namespace Modules\Product\Repositories;

use App\Repositories\Repository;
use Modules\Product\Models\Product;

class ProductRepository extends Repository{

    public function __construct(Product $product){
        $this->modelClass = $product;
    }
}