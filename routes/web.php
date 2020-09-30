<?php

use App\Http\Controllers\TaskController;
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
    return view('welcome');
});

Route::get('/tasksList/{q?}', [TaskController::class,'index']);
Route::get('/tasks/edit/{id}', [TaskController::class,'edit']);
Route::patch('/tasks/edit/{id}', [TaskController::class,'update']);
Route::post('/tasksList', [TaskController::class,'store']);
Route::delete('/tasks/{id}',[TaskController::class,'destroy']);
