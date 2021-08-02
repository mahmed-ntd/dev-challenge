<?php

use App\Http\Controllers\ControllerDevChallenge;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ControllerDevChallenge::class, 'index']);
Route::get('/view/{id}/{search}', [ControllerDevChallenge::class, 'view'])->name('view');
Route::get('/data', [ControllerDevChallenge::class, 'data'])->name('api-data');
