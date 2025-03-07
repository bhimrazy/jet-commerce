<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'verified']], function () {
     // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::redirect('/', '/admin/dashboard');
     // Category
    Route::resource('categories', CategoryController::class);
     // Product
    Route::resource('products', ProductController::class);
    
});

require_once __DIR__. '/jetstream.php';
