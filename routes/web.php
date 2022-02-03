<?php

use App\Http\Controllers\FCMController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::view('firebase', 'firebase');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/fcm-token', [FCMController::class, 'updateToken'])->name('fcmToken');
// Route::post('/send-notification', [FCMController::class,'notification'])->name('notification');

Route::get('/push-notificaiton', [FCMController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [FCMController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [FCMController::class, 'sendWebNotification'])->name('send.notification');
