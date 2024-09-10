<?php
use App\Http\Controllers\JobBoardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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


Route::get('/home', [App\Http\Controllers\JobBoardController::class, 'index'])->name('home');
Route::resource("posts", PostController::class);
Route::post('/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/search', [PostController::class, 'filter'])->name('posts.filter');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource("posts", PostController::class);
Route::middleware(['auth', 'role:employer,admin'])->group(function () {
    Route::resource('posts', PostController::class);
});

Route::resource('applications', (ApplicationController::class));
Route::get('/applications/{post_id?}', [ApplicationController::class, 'indexEmployerApp'])->name('applications.indexEmployerApp');

// applications acceptence and rejection routes
Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');