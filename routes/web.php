<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ServerController;

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
    $meta = [
        'title' => config('meta.defaults.title'),
        'description' => config('meta.defaults.description'),
        'image' => config('meta.defaults.image'),
        'robots' => config('meta.defaults.robots'),
        'web_type' => config('meta.defaults.web_type'),
        'key_words' => config('meta.defaults.key_words')
    ];

    return Inertia::render('Index', [
        'meta' => $meta
    ]);
});

Route::resource('servers', ServerController::class);
Route::resource('users', UserController::class);