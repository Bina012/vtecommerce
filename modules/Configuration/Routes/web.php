<?php

use Modules\Configuration\Controllers\CategoryController;
use Modules\Configuration\Controllers\SubCategoryController;

Route::middleware(['web', 'auth'])->namespace('Modules\Configuration\Controllers')->group(function () {
    Route::get('category',[CategoryController::class,'index'])->name('category.index');
    Route::post('category',[CategoryController::class,'store'])->name('category.store');
    Route::delete('category/{category}',[CategoryController::class,'destroy'])->name('category.destroy');

    Route::get('subcategories',[SubCategoryController::class,'index'])->name('subcategories.index');
    Route::post('subcategories',[SubCategoryController::class,'store'])->name('subcategories.store');
    Route::delete('subcategories/{subcategories}',[SubCategoryController::class,'destroy'])->name('subcategories.destroy');
});