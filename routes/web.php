<?php

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
    return view('welcome');
});


Route::middleware('auth')->group(function () {



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //postcontroller

    Route::get('/dashboard',[\App\Http\Controllers\PostController::class,'index'])->name('dashboard');
    Route::post('/facebook-clone/create',[\App\Http\Controllers\PostController::class,'store'])->name('facebook-clone.store');
    Route::get('/facebook-clone/edit/{id}',[\App\Http\Controllers\PostController::class,'edit'])->name('facebook-clone.edit');
    Route::post('/facebook-clone/update/{id}',[\App\Http\Controllers\PostController::class,'update'])->name('facebook-clone.update');
    Route::get('/facebook-clone/destroy/{id}',[\App\Http\Controllers\PostController::class,'destroy'])->name('facebook-clone.destroy');

    //like
    Route::post('/posts/{postId}/like',[\App\Http\Controllers\PostController::class,'like'] )->name('posts.like');

    //comment_count
    Route::get('/post/comment-count',[\App\Http\Controllers\PostController::class,'comment_count'])->name('comment.count');

    //comment
    Route::get('/comment',[\App\Http\Controllers\CommentController::class,'index'])->name('comments.index');
    Route::post('/comment/{postId}/store',[\App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
    Route::get('/comment/create/{postId}',[\App\Http\Controllers\CommentController::class,'create'])->name('comment.create');


});

require __DIR__.'/auth.php';
