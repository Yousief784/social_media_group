<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GroupController;
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
    return 'Main Page';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('admin')->as('admin.')->middleware(['admin_top'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/{slug}', [AdminController::class, 'show'])->name('show');
    Route::get('/edit/{slug}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/update/{slug}', [AdminController::class, 'update'])->name('update');
    Route::delete('/destroy/{slug}', [AdminController::class, 'destroy']);
});

Route::prefix('groups')->as('groups.')->group(function () {
    Route::get('/', [GroupController::class, 'index'])->name('index');
    Route::get('/create', [GroupController::class, 'create'])->name('create')->middleware(['auth']);
    Route::post('/store', [GroupController::class, 'store'])->name('store');
    Route::get('/{slug}', [GroupController::class, 'show'])->name('show');
    Route::get('/edit/{slug}', [GroupController::class, 'edit'])->name('edit')->middleware(['auth', 'admin_group']);
    Route::put('/update/{slug}', [GroupController::class, 'update'])->name('update');
    Route::delete('/destroy/{slug}', [GroupController::class, 'destroy'])->name('destroy')->middleware(['auth']);
});

Route::prefix('posts')->as('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create')->middleware(['auth']);
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/{slug}', [PostController::class, 'show'])->name('show');
    Route::get('/edit/{slug}', [PostController::class, 'edit'])->name('edit')->middleware(['auth']);
    Route::put('/update/{slug}', [PostController::class, 'update'])->name('update');
    Route::delete('/destroy/{slug}', [PostController::class, 'destroy'])->name('destroy')->middleware(['auth']);
});

// Route::prefix('comments')->as('comments.')->group([

// ], function(){
//     Route::get('/', [CommentController::class, 'index'])->name('index');
//     Route::get('/create', [CommentController::class, 'create'])->name('create');
//     Route::post('/store', [CommentController::class, 'store'])->name('store');
//     Route::get('/edit/{slug}', [CommentController::class, 'edit'])->name('edit');
//     Route::put('/update/{slug}', [CommentController::class, 'update'])->name('update');
//     Route::delete('/destroy/{slug}', [CommentController::class, 'destroy'])->name('destroy');
// });

// Route::prefix('likes')->as('likes.')->group([

// ], function(){
//     Route::get('/', [CommentController::class, 'index'])->name('index');
//     Route::get('/create', [CommentController::class, 'create'])->name('create');
//     Route::post('/store', [CommentController::class, 'store'])->name('store');
//     Route::get('/edit/{slug}', [CommentController::class, 'edit'])->name('edit');
//     Route::put('/update/{slug}', [CommentController::class, 'update'])->name('update');
//     Route::delete('/destroy/{slug}', [CommentController::class, 'destroy'])->name('destroy');
// });