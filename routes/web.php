<?php

use App\Http\Controllers\PostController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/posts", [PostController::class, "index"]);
Route::post("/posts", [PostController::class, "store"]);
Route::get("/posts/create", [PostController::class, "create"]);
Route::get("/posts/{post}", [PostController::class, "show"]);
Route::put("/posts/{post}", [PostController::class, "update"]);
Route::get("/posts/{post}/edit", [PostController::class, "edit"]);
