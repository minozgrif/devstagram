<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilControler;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

Route::get('/', HomeController::class)->name('home');

//Rutas Registro
Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store']);

//Rutas para login
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store']);
Route::post('/logout', [LogoutController::class,'store'])->name('logout');

//Rutas para el prefill
Route::get('/editar-perfil',[PerfilControler::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil',[PerfilControler::class, 'store'])->name('perfil.store');

//Rutas Posts

Route::get('/post/create', [PostController::class,'create'])->name('post.create');
Route::post('/posts', [PostController::class,'store'])->name('post.store');
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('post.show');
Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');
Route::post('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');
Route::post('/imagenes', [ImagenController::class,'store'])->name('imagenes.store');

//like a las fotos
Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('post.likes.store');
Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('post.likes.destroy');

Route::get('/{user:username}', [PostController::class,'index'])->name('post.index');

//Siguiendo usuarios
Route::post('/{user:username}/follow', [FollowerController::class,'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class,'destroy'])->name('users.unfollow');
