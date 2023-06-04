<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ServerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\EngineController;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

// Index.
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

// Content item routes.
Route::resource('servers', ServerController::class);
Route::resource('categories', CategoryController::class);
Route::resource('platforms', PlatformController::class);
Route::resource('engines', EngineController::class);

// Retrieving servers.
Route::get('/serverlist', function (Request $request) {
    // Start building our server query.
    $servers = Server::query();

    // Filter options.
    $platforms = $request->get('platforms', null);
    $categories = $request->get('categories', null);

    if ($platforms) {
        $platforms = explode(',', $platforms);
        $servers = $servers->whereIn('platform_id', $platforms);
    }

    if ($categories) {
        $categories = explode(',', $categories);
        $servers = $servers->whereIn('category_id', $categories);
    }
    
    $servers = $servers->cursorPaginate(config('SERVERS_PER_PAGE'));

    return Response::json($servers);
});

// Users.
Route::resource('users', UserController::class);