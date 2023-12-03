<?php

use Modules\Product\Controllers\ProductController;

Route::middleware(['web', 'auth'])->namespace('Modules\Product\Controllers')->group(function () {
    Route::get('product',[ProductController::class,'index'])->name('product.index');
    Route::get('product/create',[ProductController::class,'create'])->name('product.create');
    Route::get('product/{id}/view',[ProductController::class,'view'])->name('product.view');
    Route::post('product',[ProductController::class,'store'])->name('product.store');
    Route::post('product/upload',[ProductController::class,'fileupload'])->name('product.fileupload');
});