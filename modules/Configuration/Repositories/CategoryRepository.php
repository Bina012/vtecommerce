<?php

namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Category;

class CategoryRepository extends Repository{

    public function __construct(Category $category){
        $this->modelClass = $category;
    }

    public function getAllCategoriesWithProductCount()
    {
        return Category::withCount('products')->get();
    }
}