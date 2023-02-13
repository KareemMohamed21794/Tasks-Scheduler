<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskHistoriesController;
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);
Route::get('send-email', [HomeController::class, 'SendEmail']);
Route::resource('tasks', TasksController::class);
Route::get('update_status_task', [TasksController::class, 'UpdateStatusTask']);
Route::get('task_history/{task_id}', [TaskHistoriesController::class, 'TaskHistory']);
