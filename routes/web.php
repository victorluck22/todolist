<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;

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
    return view('home');
})->middleware(['auth']);



Route::get('/home', [TaskController::class, 'homeList'])->middleware(['auth'])->name('Home');

//Route::get('/home', [ItemsController::class, index])->middleware(['auth']);

/* Route::get('/projects/', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/', [ProjectController::class, 'store'])->name('projects.store'); */



Route::middleware(['auth'])->group(function(){
    Route::resource("projects", ProjectController::class);
    Route::resource("tasks", TaskController::class);
    Route::resource("users", UserController::class);
});




require __DIR__.'/auth.php';
