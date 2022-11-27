<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|   Duely note that Laravel is a shite tool that runs line by line down these
|   and finds first match. Even though the request may be containing a path variable, it
|   will ignore them. So place the routes in order of specificity (method and path).
*/

Route::get('/', function () {
    return view('/batches/create');
});

Route::resource('users', 'UserController');
Route::resource('batches', 'BatchController');

//-------------------------------------BATCH API
//PIN LOCKED
//get batch information edit view
Route::get('/batch/{id}/edit',[BatchController::class,'edit'])->name('batch.edit');
//adds batch id {id} to active execution queue
Route::post('/batch/{id}/execute',[BatchController::class,'execute'])->name('batch.execute');
//remove batch
Route::delete('/batch/{id}',[BatchController::class,'destroy'])->name('batch.delete');
//update information on specified batch to equal given request body json data
Route::post('/batch/{id}',[BatchController::class,'update'])->name('batch.update');
//view batch queue
Route::get('/batch/queue',[BatchController::class,'viewQueue'])->name('batch.queue');
//store new batch
Route::put('/batch',[BatchController::class,'create'])->name('batch.create');

//NOT PIN LOCKED
//view batch history
Route::get('/batch/history',[BatchController::class,'viewHistory'])->name('batch.history');
//get page view for single batch
Route::get('/batch/{id}',[BatchController::class,'show'])->name('batch');
//get page view for all batches
Route::get('/batch',[BatchController::class,'index'])->name('batch');


//-------------------------------------USER API
//shows edit view of user id {id}
Route::get('/users/{id}/edit',[UserController::class, 'edit'])->name('users.edit');
//returns user pin token
Route::get('/users/{id}/pin',[UserController::class, 'verifyPin'])->name('users.verifyPin');
//returns user session token
Route::get('/users/verify',[UserController::class, 'verifyUser'])->name('users.verifyUser');
//shows informational view about user
Route::get('/users/{id}',[UserController::class, 'show'])->name('users');
//shows all users
Route::get('/users',[UserController::class, 'index'])->name('users.index');
//stores new user
Route::put('/users/store',[UserController::class,'store'])->name('users.store');
//removes user
Route::delete('/users/{id}',[UserController::class, 'destroy'])->name('users.destroy');
//updates the information on user id {id} to equal given request body json data
Route::post('/users/{id}',[UserController::class, 'update'])->name('users.update');

