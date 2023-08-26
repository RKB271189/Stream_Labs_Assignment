<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/login/redirect', [AuthController::class, 'providerRedirect']);
Route::post('/provider/callback', [AuthController::class, 'providerCallback']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/get-activity', [DashboardController::class, 'getActivity']);
});
