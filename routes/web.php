<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // 記事関連のルート
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    // 記事更新のためのルート
    Route::post('/articles/update', [ArticleController::class, 'update'])->name('articles.update');
 // 記事の更新フォームページへのルート
    Route::get('/articles/edit/{article}', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::post('/articles/{article}/likes', [LikeController::class, 'store'])->name('articles.likes.store');
    Route::delete('/articles/{article}/likes', [LikeController::class, 'destroy'])->name('articles.likes.destroy');

// ユーザーがブックマークした記事のリストを表示するルート
Route::get('/bookmarks', [App\Http\Controllers\BookmarkController::class, 'index'])->name('bookmarks.index');

});

require __DIR__.'/auth.php';
