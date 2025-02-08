<?php

use App\Http\Controllers\admin\AdminController as AdminAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\TotalBillsController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/admin', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role->name === 'admin') {
            return redirect()->route('admin.dashboard');
        }
    }
    return redirect()->route('login');
})->name('admin.dashboard');

Auth::routes(['middleware' => ['redirectIfAuthenticated']]);

Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('invoices', InvoiceController::class);

    Route::put('/invoices/{invoice}/confirm', [InvoiceController::class, 'confirmPayment'])->name('admin.confirmPayment');
    Route::put('/invoices/{invoice}/reject', [InvoiceController::class, 'rejectPayment'])->name('admin.rejectPayment');
    Route::get('/total-user', [TotalBillsController::class, 'index'])->name('admin.total-bills.index');
});

Route::get('/home', [UserController::class, 'index'])->name('home');
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/products-detail/{id}', [UserController::class, 'show'])->name('products-detail.show');
Route::get('/cart', [UserController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [UserController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/add-detail', [UserController::class, 'addToCartDetail'])->name('cart.add-detail');
Route::post('/checkout', [UserController::class, 'checkout'])->name('checkout');
Route::get('/billing/{order}', [UserController::class, 'showBilling'])->name('billing.show');
Route::post('/payment/{order}/process', [UserController::class, 'processPayment'])->name('payment.process');
Route::get('/all-products', [UserController::class, 'showAllProducts'])->name('all-products');
