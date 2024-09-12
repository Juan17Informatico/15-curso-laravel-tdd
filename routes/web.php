<?php

use App\Http\Controllers\RepositoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('repositories', RepositoryController::class)->middleware('auth');