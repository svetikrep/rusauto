<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [CarController::class, 'index'])->name('cars.index');
Route::get('/catalog/{car:slug}', [CarController::class, 'show'])->name('cars.show');

Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::post('/session/clear-viewed', function () {
    session()->forget('recently_viewed');
    session()->flash('info', 'История просмотров очищена.');
    return redirect()->back();
})->name('session.clear-viewed');
