<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'UserAuth'],function(){
    Route::get('login',[LoginController::class,'login'])->name('login');
    Route::post('login',[LoginController::class,'authenticate'])->name('auth.login');
    Route::get('/',[DashboardController::class,'public'])->name('dashboard.public');

});

Route::middleware(['auth'])->group(function () {
    Route::get('logout',[LoginController::class,'logout'])->name('user.logout');
});

Route::middleware(['auth'])->group(function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
});

// Route::get('/login', function () {
//     return view('auth.login');
// });



// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Auth::routes();

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
//     Route::get('logout', [TonerController::class, 'logout']);

//     Route::get('{any}', [TonerController::class, 'index']);
//     Route::get('components/{any}', [TonerController::class, 'components']);
// });

