<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoListController;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('home', 'index')->name('home');
        Route::get('todo-lists', 'todoLists')->name('todo-lists');
    });

    Route::resource('todos', TodoListController::class, ['except' => ['create', 'edit']]);
});
