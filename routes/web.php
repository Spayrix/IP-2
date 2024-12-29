<?php


use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;


// Kategori rotaları
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Ürün rotaları
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// İletişim sayfası
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Auth rotaları
Auth::routes();

// Ana sayfa
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Ürün kaynak rotaları
Route::resource('products', ProductController::class)->except(['index', 'show']); // Zaten yukarıda tanımlandı.
Route::get('products/category/{id}', [ProductController::class, 'category'])->name('products.category');

Route::get('/about', [AboutUsController::class, 'index'])->name('about');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
Route::post('/address/store', [UserController::class, 'storeAddress'])->name('address.store');


Route::middleware(['auth'])->group(function () {

    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/address/store', [ProfileController::class, 'storeAddress'])->name('address.store');
});
