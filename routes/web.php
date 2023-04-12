<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;


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

// Route::get('/', function () {
//     return 'Hello world';
// });

Route::get('/',[indexController::class, 'index'])->name('index');
Route::post('/add', [indexController::class, 'add'])->name('addTodo');
Route::get('/remaining', [indexController::class, 'remainingTodo'])->name('remainingTodo');
Route::get('/completed', [indexController::class, 'completedTodo'])->name('completedTodo');
Route::post('/remove/{todo}',[indexController::class, 'remove'])->name('removeTodo');
Route::post('/complete/{todo}',[indexController::class, 'complete'])->name('completeTodo');
Route::post('/clear-completed', [indexController::class, 'clearCompleted'])->name('clearCompletedTodo');