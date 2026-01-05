<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/logout', function (Request $request) {
    return app(\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class)->destroy($request);
})->middleware(['auth',])->name('logout');

Route::get('/course/{slug}', [CourseController::class, 'show'])->name('course.show');

// Halaman Penawaran Premium
Route::get('/subscribe', [SubscriptionController::class, 'index'])->name('subscription.index');

// Proses Upgrade (POST)
Route::post('/subscribe/process', [SubscriptionController::class, 'upgrade'])->name('subscription.upgrade');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('courses', AdminCourseController::class);
});
