<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\OPCClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\views;
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

//Route::resource('users', 'UserController');
//Route::resource('batches', 'BatchController');

//-------------------------------------views
Route::get('/login', [LoginController::class, 'show'])->name("login");
Route::get('/logout', [LoginController::class, 'logout'])->name("logout");
Route::post('/doLogin', [LoginController::class, 'login'])->name("doLogin");

Route::get('/', [views::class, 'index'])->name("home");
Route::get('/brew', [views::class, 'brew'])->name("brew");
Route::get('/admin', [views::class, 'admin'])->name("admin");
Route::delete('/batch/{id}', [BatchController::class, 'destroy'])->name("destroyBatch");


//read
Route::get('/api/read/inventory', [OPCClientController::class, 'getInventoryStatus'])->name("getDash");
Route::get('/api/read/nodes/{nodeNames}', [OPCClientController::class, 'readNodes'])->name("getDash");
Route::get('/api/getAdmin', [views::class, 'getAdmin'])->name("getAdmin");  //rewrite
Route::get('/api/getServerS', [views::class, 'getServerS'])->name("getServerS"); //rewrite

//show create user page
Route::get('/create', [UserController::class, 'create'])->name("create");
Route::post('/create', [UserController::class, 'store'])->name("createStore");

Route::post('/api/write/{id}', [views::class, 'post'])->name("post"); //rewrite
Route::post('/api/write/set_command/{command}', [views::class, 'sendCommand'])->name("sendCommand"); //rewrite
Route::post('/api/write/brew', [BatchController::class, 'storeAndExecute'])->name("storeAndExecute");
Route::post('/api/write/brew/store', [BatchController::class, 'store'])->name("store");
Route::post('/batch/store/current', [OPCClientController::class, 'storeCurrentBatchResult']);

//-------------------------------------views

//-------------------------------------BATCH API
//PIN LOCKED
//get batch information edit view
//Route::get('/batch/{id}/edit',[BatchController::class,'edit'])->name('batch.edit');
//adds batch id {id} to active execution queue
Route::post('/batch/{id}/execute',[BatchController::class,'execute'])->name('batch.execute');
//remove batch
//Route::delete('/batch/{id}',[BatchController::class,'destroy'])->name('batch.delete');
//update information on specified batch to equal given request body json data
//Route::put('/batch/{id}',[BatchController::class,'update'])->name('batch.update');
//view batch queue
//Route::get('/batch/queue',[BatchController::class,'viewQueue'])->name('batch.queue');
//store new batch
Route::post('/batch',[BatchController::class,'store'])->name('batch.create');

//NOT PIN LOCKED
//view batch history
Route::get('/batch/history',[BatchController::class, 'history'])->name('batches.history');
//get page view for single batch
Route::get('/batch/{id}',[BatchController::class,'show'])->name('batch');
//get page view for all batches
Route::get('/batches',[BatchController::class,'index'])->name('batches');


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
