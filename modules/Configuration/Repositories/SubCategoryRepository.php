<?php

namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\SubCategory;

class SubCategoryRepository extends Repository{

    public function __construct(SubCategory $subcategory){
        $this->modelClass = $subcategory;
    }
}