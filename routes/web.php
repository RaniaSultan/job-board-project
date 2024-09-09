<?php
use App\Http\Controllers\JobBoardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
// jobboard.show
// Route::get('/posts/{id}', [JobBoardController::class, 'show'])->name('jobboard.show');
