<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ServerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\EngineController;

use App\Models\Server;

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
    // Generate stock meta data.
    $meta = gen_meta();

    // Retrieve all servers.
    $servers = Server::all();

    return Inertia::render('Index', [
        'meta' => $meta,
        'servers' => $servers
    ]);
});

Route::resource('servers', ServerController::class);
Route::resource('categories', CategoryController::class);
Route::resource('platforms', PlatformController::class);
Route::resource('engines', EngineController::class);

Route::resource('users', UserController::class);