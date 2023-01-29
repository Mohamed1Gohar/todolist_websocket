<?php

use App\Events\Hello;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\HomeController;
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
});

// for test
//Route::get('/broadcasting',function(){
//    return Hello::dispatch();
//    broadcast(new Hello());
//    return "Event has been sent!";
//});
