<?php

use Modules\Configuration\Controllers\CategoryController;

Route::middleware(['web', 'auth'])->namespace('Modules\Configuration\Controllers')->group(function () {
    Route::get('category',[CategoryController::class,'index'])->name('category.index');
    Route::get('category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('category',[CategoryController::class,'store'])->name('category.store');
    Route::delete('category/{category}',[CategoryController::class,'destroy'])->name('category.destroy');
});