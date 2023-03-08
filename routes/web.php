<?php

use App\Http\Controllers\SmsHashTagController;
use App\Http\Controllers\SmsMailCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsMailController;
use App\Http\Controllers\SmsMailTemplateController;
use App\Http\Controllers\SmsMailTemplateHashtagController;
use App\Http\Controllers\SmsTenantController;

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
        Route::prefix('/sms-mail')->as('sms-mail.')->group(function() {
            Route::get('', [SmsMailController::class,'index'])->name('index');
            Route::get('create', [SmsMailController::class,'create'])->name('create');
            Route::post('', [SmsMailController::class,'store'])->name('store');
            Route::post('data', [SmsMailController::class,'data'])->name('data');
            Route::get('{id}', [SmsMailController::class,'show'])->name('show');
            Route::get('{id}/edit', [SmsMailController::class,'edit'])->name('edit');
            Route::put('{id}', [SmsMailController::class,'update'])->name('update');
            Route::delete('{id}', [SmsMailController::class,'destroy'])->name('destroy');
        });

        Route::prefix('/sms-hashtag')->as('sms-hashtag.')->group(function() {
            Route::post('json', [SmsHashTagController::class,'json'])->name('json');
            Route::post('html', [SmsHashTagController::class,'html'])->name('html');

        });

        Route::prefix('/sms-tenant')->as('sms-tenant.')->group(function() {
            Route::post('json', [SmsTenantController::class,'json'])->name('json');
            Route::post('html', [SmsTenantController::class,'html'])->name('html');
        });

        Route::prefix('/sms-mail-category')->as('sms-mail-category.')->group(function() {
            Route::post('json', [SmsMailCategoryController::class,'json'])->name('json');
        });

        Route::prefix('/sms-mail-template')->as('sms-mail-template.')->group(function() {
            Route::post('json', [SmsMailTemplateController::class,'json'])->name('json');
        });

        Route::prefix('/sms-mail-template-hashtag')->as('sms-mail-template-hashtag.')->group(function() {
            Route::post('html', [SmsMailTemplateHashtagController::class,'html'])->name('html');
        });



    });
});
