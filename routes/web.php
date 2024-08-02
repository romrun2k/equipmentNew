<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EquipmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //orders
    Route::resource('orders', OrderController::class);
    Route::middleware(['isAdmin'])->group(function() {
        //employees
        Route::resource('employees', EmployeeController::class);
        //quipment
        Route::get('quipments/{quipment}/edit', [EquipmentController::class , 'edit'])->name('quipments.edit');
        Route::resource('quipments', EquipmentController::class);
    });
});




require __DIR__.'/auth.php';
