<?php

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

Route::get('/Tasks', [TasksController::class,'index'])->name('Tasks');
Route::delete('/Tasks/{id}', [TasksController::class,'DeleteTask']);
Route::get('/SortTasks', [TasksController::class,'SortTasks']);
Route::post('/EditTask', [TasksController::class,'EditTask'])->name('EditTask');


Route::get('/CategorizedTasks', [TasksController::class,'CategorizedTasks'])->name('CategorizedTasks');
Route::delete('/CategorizedTasks/{id}', [TasksController::class,'DeleteTask']);

Route::get('/CreateTask', [TasksController::class, 'create'])->name('CreateTask');
Route::post('/CreateTask', [TasksController::class, 'store']);



Route::get('/login', function () {
    return view('Control.Login');
});
