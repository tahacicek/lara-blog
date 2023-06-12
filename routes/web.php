<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Customer\HomepageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('layouts.guest');
});


Route::get('/',[HomepageController::class,'index'])->name('homepage');

Route::middleware('auth', 'isAdmin', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category/func', [CategoryController::class, 'operations'])->name('category.operations');
    Route::get('/category/order', [CategoryController::class, 'order'])->name('category.order');
    //post
    Route::get('/posts',  [PostController::class, 'index'])->name('post');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/insert',  [PostController::class, 'insert'])->name('post.insert');
    Route::get('/post/edit/{id}',  [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/update/{id}',  [PostController::class, 'update'])->name('post.update');
    Route::post('/post/func',  [PostController::class, 'operations'])->name('post.operations');
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
