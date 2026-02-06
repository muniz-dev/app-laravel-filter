<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ProductFilter;

Route::get('/', ProductFilter::class)->name('products.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/activity-logs', [App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('/search-logs', [App\Http\Controllers\Admin\SearchLogController::class, 'index'])->name('search-logs.index');
});
