<?php

use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Controllers\ReviewController;
use App\Controllers\SearchController;
use App\Kernel\Router\Route;
use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index'],[GuestMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [LoginController::class, 'index'],[GuestMiddleware::class]),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),
    Route::get('/admin', [AdminController::class, 'index'], [AdminMiddleware::class]),
    Route::get('/admin/categories/add', [CategoryController::class, 'create'],[AdminMiddleware::class]),
    Route::post('/admin/categories/add', [CategoryController::class, 'store'],[AdminMiddleware::class]),
    Route::post('/admin/categories/destroy', [CategoryController::class, 'destroy'],[AdminMiddleware::class]),
    Route::get('/admin/categories/update', [CategoryController::class, 'edit'],[AdminMiddleware::class]),
    Route::post('/admin/categories/update', [CategoryController::class, 'update'],[AdminMiddleware::class]),
    Route::get('/admin/movies/add', [MovieController::class, 'create'],[AdminMiddleware::class]),
    Route::post('/admin/movies/add', [MovieController::class, 'store'],[AdminMiddleware::class]),
    Route::post('/admin/movies/destroy', [MovieController::class, 'destroy'],[AdminMiddleware::class]),
    Route::get('/admin/movies/update', [MovieController::class, 'edit'],[AdminMiddleware::class]),
    Route::post('/admin/movies/update', [MovieController::class, 'update',[AdminMiddleware::class]]),
    Route::get('/movie', [MovieController::class, 'show']),
    Route::post('/reviews/add', [ReviewController::class, 'store']),
    Route::get('/reviews/delete',[ReviewController::class,'deleteReview']),
    Route::post('/editreview',[ReviewController::class,'editReview']),
    Route::get('/categories', [CategoryController::class, 'index']),
    Route::get('/category', [HomeController::class, 'showFilm']),
    Route::get('/best', [HomeController::class, 'showByRating']),
    Route::get('/search', [SearchController::class, 'index'])
];
