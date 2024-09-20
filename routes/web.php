<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RepositoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ PageController::class, 'home' ] );

Route::resource('repositories', RepositoryController::class)->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
