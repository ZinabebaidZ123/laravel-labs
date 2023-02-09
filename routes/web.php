<?php

use App\Http\Controllers\commentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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
    return view('welcome');
});
////////////// Posts  ///////////////////////////////////////////////////
Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/update', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/delete/{post}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::get('/comments', [commentController::class, 'index'])->name('comments.index');
    Route::post('/comments/store', [commentController::class, 'store'])->name('comments.store');
});
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


////////////////// Comments ////////////////////////////////////


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/github/login', function () {
    return Socialite::driver('github')->redirect();
})->name('github.login');

Route::get('/github/home', function () {
    $githubUser = Socialite::driver('github')->user();

dd($githubUser);
    // $user = User::updateOrCreate([
    //     'id' => $githubUser->id,
    //     'name' => $githubUser->name,
    //     'email' => $githubUser->email,
    //     'password' => "12345678"
    // ]);

    // Auth::login($user);
    // return redirect('/');
})->name('github.home');


Route::get('/linkedin/login', function () {
    return Socialite::driver('linkedin')->redirect();
})->name('linkedin.login');

Route::get('/linkedin/home', function () {
    $linkedinUser = Socialite::driver('linkedin')->user();
    dd($linkedinUser);
    // $user = User::updateOrCreate([
    //     'id' => $githubUser->id,
    //     'name' => $githubUser->name,
    //     'email' => $githubUser->email,
    //     'password' => "12345678"
    // ]);

    // Auth::login($user);
    return redirect('/');
})->name('linkedin.home');
