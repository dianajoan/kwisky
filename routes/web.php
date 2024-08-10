<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('phonebook');
});

Route::post('/search', [ContactController::class, 'search']);
Route::post('/store', [ContactController::class, 'store']);
