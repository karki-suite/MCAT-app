<?php

use App\Http\Controllers\Content\SampleTestsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Content\ScheduleController;
use App\Http\Controllers\Content\CarsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/resources', [DashboardController::class, 'resources'])
    ->middleware(['auth', 'verified'])
    ->name('resources');

Route::get('/schedule', [ScheduleController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('schedule');

Route::post('/schedule', [ScheduleController::class, 'save'])
    ->middleware(['auth', 'verified'])
    ->name('schedule.save');

Route::get('/cars', [CarsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('cars');

Route::post('/cars', [CarsController::class, 'save'])
    ->middleware(['auth', 'verified'])
    ->name('cars.save');

Route::get('/sample-tests', [SampleTestsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('sampletests');

Route::get('/sample-tests/{id}', [SampleTestsController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('sampletests.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::controller(App\Http\Controllers\Auth\GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirect')->name('auth.google');
    Route::get('auth/google/callback', 'googleCallback');
});
