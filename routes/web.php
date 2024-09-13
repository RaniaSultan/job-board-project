<?php
use App\Http\Controllers\JobBoardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [JobBoardController::class, 'index'])->name('home');

Route::resource("comments", CommentController::class);
Route::resource("posts", PostController::class);

Route::post('/search', [PostController::class, 'search'])->name('posts.search');

Route::resource('applications', ApplicationController::class);

Route::post('applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
Route::post('applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
Route::post('applications/{application}/cancel', [ApplicationController::class, 'cancel'])->name('applications.cancel');

Route::middleware('auth')->group(function() {
    
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.index');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
