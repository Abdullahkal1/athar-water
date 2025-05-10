<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;

require __DIR__.'/auth.php';

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/customer/order/{id}', [CustomerController::class, 'order'])->name('customer.order'); // استبدل checkRole بـ auth
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard'); // استبدل checkRole بـ auth
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit'); // استبدل checkRole بـ auth
    Route::patch('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update'); // استبدل checkRole بـ auth
    Route::delete('/customer/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy'); // استبدل checkRole بـ auth

    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
    Route::post('/customer/order/{id}', [CustomerController::class, 'order'])->name('customer.order');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/supplier/dashboard', [SupplierController::class, 'dashboard'])->name('supplier.dashboard'); // استبدل checkRole بـ auth
    Route::patch('/supplier/mark-as-delivered/{id}', [SupplierController::class, 'markAsDelivered'])->name('supplier.markAsDelivered'); // استبدل checkRole بـ auth

    Route::patch('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');

    Route::get('/admin/dashboard', function () {
        $orders = \App\Models\Order::all();
        $donations = \App\Models\Donation::all();
        $suppliers = \App\Models\User::where('role', 'supplier')->get();
        $weeklyOrders = \App\Models\Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $weeklyDonations = \App\Models\Donation::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $monthlyOrders = \App\Models\Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $monthlyDonations = \App\Models\Donation::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $notifications = \App\Models\Notification::where('read', false)->get();
        return view('admin.dashboard', compact('orders', 'donations', 'suppliers', 'weeklyOrders', 'weeklyDonations', 'monthlyOrders', 'monthlyDonations', 'notifications'));
    })->name('admin.dashboard'); 

    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'supplier') {
            return redirect()->route('supplier.dashboard');
        }
        return redirect('/home');
    })->name('dashboard');

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/test-role', function () {
        return "Role Middleware Works!";
    }); 

    Route::get('/test-middleware', function () {
        return "Middleware works!";
    }); 

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    });
});