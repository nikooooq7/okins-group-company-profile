<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Middleware\AdminTokenAuth;

Route::get('/public-content', [PublicController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1');
Route::post('/admin/login', [AdminController::class, 'login'])->middleware('throttle:5,1');
Route::middleware([AdminTokenAuth::class])->prefix('admin')->group(function () {
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::put('/profile', [AdminController::class, 'updateProfile']);
    Route::post('/missions', [AdminController::class, 'createMission']);
    Route::delete('/missions/{mission}', [AdminController::class, 'deleteMission']);
    Route::post('/divisions', [AdminController::class, 'createDivision']);
    Route::delete('/divisions/{division}', [AdminController::class, 'deleteDivision']);
});
