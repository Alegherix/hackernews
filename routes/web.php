<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name("welcome");
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get("/posts", [PostController::class, "index"]);
Route::post("/posts", [PostController::class, "store"]);
Route::get("/posts/create", [PostController::class, "create"]);
Route::get("/posts/{post}", [PostController::class, "show"])->name("posts.show");
Route::put("/posts/{post}", [PostController::class, "update"]);
Route::get("/posts/{post}/edit", [PostController::class, "edit"])->name("posts.edit");

Route::delete("/posts/{id}", [PostController::class, "destroy"])->name("posts.destroy");

Route::put("/settings", [UserController::class, "update"]);
Route::get("/settings", [UserController::class, "edit"])->name("settings");
Route::get("/users/{id}", [UserController::class, "show"]);


Route::post("/comments/{post}", [CommentController::class, "store"]);
Route::delete("/comments/{id}", [CommentController::class, "destroy"])->name("comment.destroy");
