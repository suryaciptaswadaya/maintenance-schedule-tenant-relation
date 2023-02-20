<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaintenanceScheduleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
]);
Route::redirect('/', url('/administrator/dashboard'));

Route::group(['middleware' => 'auth'], function () {
    // ini nanti aksesnya jadi contoh.com/administrator
    Route::prefix('/administrator')->as('administrator.')->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // ini nanti aksesnya jadi contoh.com/administrator/maintenance-schedule
        Route::prefix('/maintenance-schedule')->as('maintenance-schedule.')->group(function() {
        Route::get('', [MaintenanceScheduleController::class,'index'])->name('index');
            Route::get('create', [MaintenanceScheduleController::class,'create'])->name('create');
            Route::post('', [MaintenanceScheduleController::class,'store'])->name('store');
            Route::post('data', [MaintenanceScheduleController::class,'data'])->name('data');
            Route::get('{id}', [MaintenanceScheduleController::class,'show'])->name('show');
            Route::get('{id}/edit', [MaintenanceScheduleController::class,'edit'])->name('edit');
            Route::put('{id}', [MaintenanceScheduleController::class,'update'])->name('update');
            Route::delete('{id}', [MaintenanceScheduleController::class,'destroy'])->name('destroy');
        });
    });
});
