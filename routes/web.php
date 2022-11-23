<?php

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

Route::get('/', function () {
    return view('/batches/create');
});

Route::resource('users', 'UserController');
Route::resource('batches', 'BatchController');

Route::get('create', [\App\Http\Controllers\QueuedBatchController::class, 'create']);
Route::post('create', [\App\Http\Controllers\QueuedBatchController::class, 'create'])->name('create');
