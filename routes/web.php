<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;

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
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('applications', (ApplicationController::class));
Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
// applications acceptence and rejection routes
Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');

Route::resource("posts", PostController::class);
Route::post('/search', [PostController::class, 'search'])->name('posts.search');
// jobboard.show
// Route::get('/posts/{id}', [JobBoardController::class, 'show'])->name('jobboard.show');

