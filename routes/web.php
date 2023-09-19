<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

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

Route::get('/', [UserController::class, "goback"]);
Route::get('/signup', [UserController::class, "signup"]);
Route::get('/home', [UserController::class, "showHome"]);
Route::get('/myprofile/{user:username}', [UserController::class, "profile"]);
Route::get('/otherprofile/{user:username}', [UserController::class, "otherProfile"]);


Route::post('/register', [UserController::class, "register"]);
Route::post('/', [UserController::class, "signin"]);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::post('/home', [UserController::class, 'showUserDistance']);
Route::post('/myprofile/{user:username}/edit', [UserController::class, 'edit'])->middleware('auth');
Route::post('/myprofile/{user:username}', [UserController::class, 'update']);

Route::post('create-follow/{user:username}', [FollowController::class, 'createFollow'])->middleware('auth');
Route::post('match/{user:username}', [FollowController::class, 'match'])->middleware('auth');
Route::post('remove-follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware('auth');
Route::post('delete-follow/{user:username}', [FollowController::class, 'deleteFollow'])->middleware('auth');
