<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReportController; // ДОБАВИЛИ ИМПОРТ
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', [MainController::class, 'index'])->name('home');

// Страница категорий и фильтрация
Route::get('/category/{id}', [MainController::class, 'showCategory'])->name('category.show');

// Стандартный дашборд
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Группа для авторизованных пользователей
Route::middleware('auth')->group(function () {

    // ПРОФИЛЬ
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // КОРЗИНА
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

    // ОПЛАТА
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/process', [OrderController::class, 'process'])->name('order.process');
});

require __DIR__ . '/auth.php';

// Группа маршрутов админки
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // ТОВАРЫ
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');

    // ОТЧЕТЫ (ДОБАВИЛИ СЮДА)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});