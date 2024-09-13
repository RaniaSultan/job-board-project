<?php
use App\Http\Controllers\JobBoardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\AdminController;

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

Route::resource("posts", PostController::class);
Route::post('/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/search', [PostController::class, 'filter'])->name('posts.filter');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource("posts", PostController::class);

// Route::resource("comments", CommentController::class);
Route::get('/home', [App\Http\Controllers\JobBoardController::class, 'index'])->name('home');
Route::middleware(['auth', 'role:employer,admin'])->group(function () {
    Route::resource('posts', PostController::class);
});

Route::get('/posts/showOnePost/{id}', [PostController::class, 'showForEveryOne'])->name('posts.showForEveryOne');
Route::post('/search', [PostController::class, 'search'])->name('posts.search');


Route::resource('applications', (ApplicationController::class));
Route::get('/applications/{post_id?}', [ApplicationController::class, 'indexEmployerApp'])->name('applications.indexEmployerApp');
Route::get('/create/application/{post_id?}', action: [ApplicationController::class, 'createApp'])->name('applications.createApp');

// applications acceptence and rejection routes
Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
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
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/pending-posts', [AdminController::class, 'pendingPosts'])->name('admin.pending-posts');
    Route::post('/admin/posts/{id}/approve', [AdminController::class, 'approvePost'])->name('admin.posts.approve');
    Route::post('/admin/posts/{id}/reject', [AdminController::class, 'rejectPost'])->name('admin.posts.reject');
});


