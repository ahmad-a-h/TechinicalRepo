<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TasksController;
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

Route::get('/Tasks', [TasksController::class,'index'])->name('Tasks')->middleware('auth');
Route::delete('/Tasks/{id}', [TasksController::class,'DeleteTask'])->middleware('auth');;
Route::get('/SortTasks', [TasksController::class,'SortTasks'])->middleware('auth');
Route::get('/EditTask/{id}', [TasksController::class,'EditTask'])->name('EditTask')->middleware('auth');
Route::post('/SaveTask/{id}', [TasksController::class, 'SaveTask'])->name('SaveTask')->middleware('auth');


Route::get('/CategorizedTasks', [TasksController::class,'CategorizedTasks'])->name('CategorizedTasks')->middleware('auth');
Route::delete('/CategorizedTasks/{id}', [TasksController::class,'DeleteTask'])->middleware('auth');
Route::get('/GoToCreateCategory', [TasksController::class,'GoToCreateCategory'])->name('GoToCreateCategory')->middleware('auth');
Route::post('/CreateCategory', [TasksController::class,'CreateCategory'])->name('CreateCategory')->middleware('auth');
Route::delete('/DeleteCategory/{id}', [TasksController::class,'DeleteCategory'])->name('DeleteCategory')->middleware('auth');

Route::get('/CreateTask', [TasksController::class, 'create'])->name('CreateTask')->middleware('auth');
Route::post('/CreateTask', [TasksController::class, 'store'])->middleware('auth');


Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/login', [RegisterController::class, 'login'])->name('login');
Route::post('/login', [RegisterController::class, 'SubmitLogin'])->name('SubmitLogin');
Route::get('/logout', [RegisterController::class, 'logout'])->name('logout');

