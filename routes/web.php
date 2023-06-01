<?php

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

/* GET ROUTES */

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);

/* POST ROUTES */

Route::post('/data/seeEvent', [\App\Http\Controllers\HomeController::class, 'seeEvent']);
Route::post('/data/addEvent', [\App\Http\Controllers\HomeController::class, 'addEvent']);
Route::post('/data/updateEvent', [\App\Http\Controllers\HomeController::class, 'updateEvent']);
Route::post('/data/removeEvent', [\App\Http\Controllers\HomeController::class, 'removeEvent']);