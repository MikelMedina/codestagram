<?php

use App\Livewire\LikePost;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PasswordResetLinkController;

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

//GUEST 
Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login'); //falta proteger con un middleware para que si el usuario ya ha iniciado sesión le redirija al perfil
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');
});

//LOGGUED 
Route::middleware('auth')->group(function() {

    //POST
    Route::get('/{user:username}/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/{user:username}/post/create', [PostController::class, 'store']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::post('/uploads/imagenes', [ImagenController::class, 'store'])->name('imagen.upload');

    //COMMENT
    Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentario.store');

    //PROFILE
    Route::get('{user:username}/edit', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::put('{user:username}/edit', [ProfileController::class, 'update'])->name('perfil.update');
    
    //FOLLOW
    Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('follow');
    Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('unfollow');
    
    //FEED
    Route::get('/feed', HomeController::class)->name('feed'); 

    //AUTH LOGOUT
    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');




});

//PUBLIC ROUTES (authenticated and guest users)
Route::get('/{user:username}', [ProfileController::class, 'index'])->name('profile');
Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('post.show');














