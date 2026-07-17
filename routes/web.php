<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReportController;

use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Admin\InventoryController;

use App\Http\Controllers\ProfileController;

Route::get('/', [ShopController::class, 'index'])->name('shop');

Route::get('/products', [ShopController::class, 'products'])->name('shop.products');

Route::get('/categories', [ShopController::class, 'categories'])->name('shop.categories');

Route::get('/category/{category}', [ShopController::class, 'category'])->name('shop.category');

Route::get('/product/{product}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/search', [ShopController::class, 'search'])->name('shop.search');


Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store');

});



Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');

    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');

    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');


    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/place-order', [CheckoutController::class, 'store'])
        ->name('checkout.store');


    Route::get('/orders', [CustomerOrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])
        ->name('orders.show');


    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');

});

Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);

        Route::resource('products', ProductController::class);

        Route::resource('orders', AdminOrderController::class);

        Route::resource('customers', CustomerController::class);
        
            Route::get('/inventory', [InventoryController::class, 'index'])
                ->name('inventory.index');

            Route::get('/inventory/{product}/edit', [InventoryController::class, 'edit'])
                ->name('inventory.edit');

            Route::put('/inventory/{product}', [InventoryController::class, 'update'])
                ->name('inventory.update');

    });
    Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');

   
    Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

});