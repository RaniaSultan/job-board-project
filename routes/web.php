<?php
use App\Http\Controllers\JobBoardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

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
Route::resource("comments", CommentController::class);
Route::get('/home', [App\Http\Controllers\JobBoardController::class, 'index'])->name('home');
Route::middleware(['auth', 'role:employer,admin'])->group(function () {
    Route::resource('posts', PostController::class);
});
Route::post('/search', [PostController::class, 'search'])->name('posts.search');

// jobboard.show
// Route::get('/posts/{id}', [JobBoardController::class, 'show'])->name('jobboard.show');

/**application in progress*/
// Route::resource("posts", PostController::class);
// Route::resource('applications', (ApplicationController::class));
// Route::get('/applications/{post_id?}', [ApplicationController::class, 'index'])->name('applications.index');

/**application in progress*/
// applications acceptence and rejection routes
// Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
// Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');

// downloadResmume
Route::get('/downloadResmume', [ApplicationController::class, 'downloadResume'])->name('downloadResume');
Route::resource('applications', (ApplicationController::class));
Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// applications acceptence and rejection routes
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
Route::post('applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
Route::post('applications/{application}/cancel', [ApplicationController::class, 'cancel'])->name('applications.cancel');