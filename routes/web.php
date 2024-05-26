<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; // Corrected namespace
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
Route::get('/todos', function () {
    // Your route logic here
})->middleware('auth.user');



Route::get('/', function () {
    return view('index');
});

Route::get('/home',function () {
    return view('index');
});

Route::get('/login',function () {
    return view('login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/todos',[PageController::class,'todos'])->name('todos');
    Route::post('/savetask', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/update{id}',[TaskController::class,'update'])->name('tasks.update');
    Route::delete('/destroy{id}',[TaskController::class,'destroy'])->name('tasks.destroy');
});
Route::get('/register',function () {
    return view('register');
}
)->name('register');


Route::post('/login',[LoginController::class,'authenticate'])->name('login');
Route::post('/userregister',[RegisterController::class,'register'])->name('userregister');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
