<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Public Routes
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // Employee
    Route::resource('employees', \App\Http\Controllers\Admin\EmployeeController::class);

    // Attendance
    Route::get('/attendance', [\App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [\App\Http\Controllers\Admin\AttendanceController::class, 'store'])->name('attendance.store');
    // Inventory
    Route::resource('inventory', \App\Http\Controllers\Admin\InventoryController::class);
    Route::post('/inventory/{inventory}/stock-in', [\App\Http\Controllers\Admin\InventoryController::class, 'stockIn'])->name('inventory.stock-in');
    Route::post('/inventory/{inventory}/stock-out', [\App\Http\Controllers\Admin\InventoryController::class, 'stockOut'])->name('inventory.stock-out');
    Route::get('/inventory/{inventory}/transactions', [\App\Http\Controllers\Admin\InventoryController::class, 'transactions'])->name('inventory.transactions');

    // Stock Transactions
    Route::get('/stock', [\App\Http\Controllers\Admin\StockController::class, 'index'])->name('stock.index');
    Route::post('/stock', [\App\Http\Controllers\Admin\StockController::class, 'store'])->name('stock.store');

    // Suppliers
    Route::resource('suppliers', \App\Http\Controllers\Admin\SupplierController::class);
    Route::get('/suppliers', [\App\Http\Controllers\Admin\SupplierController::class, 'index'])->name('suppliers.index');
    Route::post('/suppliers', [\App\Http\Controllers\Admin\SupplierController::class, 'store'])->name('suppliers.store');
    Route::delete('/suppliers/{supplier}', [\App\Http\Controllers\Admin\SupplierController::class, 'destroy'])->name('suppliers.destroy');
});

// Manager Routes
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'manager'])->name('dashboard');
});

// Worker Routes
Route::middleware(['auth', 'role:worker'])->prefix('worker')->name('worker.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'worker'])->name('dashboard');
});

// Buyer Routes
Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->name('buyer.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'buyer'])->name('dashboard');
});