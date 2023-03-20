<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\QueryController;
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
    if (\Auth::check())
    {
        return \Redirect::route('queries.all');
    }
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        

    
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /** Database routes **/

    Route::get('/databases', [DatabaseController::class, 'index'])->name('databases.all');
    //Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/databases/{database}/edit', [DatabaseController::class, 'edit'])->name('databases.edit');
    Route::get('/databases/create', [DatabaseController::class, 'create'])->name('databases.create');
    Route::post('/databases', [DatabaseController::class, 'store'])->name('databases.store');
    Route::put('/databases/{database}',[DatabaseController::class,'update'])->name('databases.update');
    //Route::delete('/projects/{project}',[ProjectController::class,'destroy'])->name('projects.destroy');

     /** Query routes **/
    Route::get('/querys',[QueryController::class, 'executeTableQuery'])->name('query.exe');

    Route::get('/queries', [QueryController::class, 'index'])->name('queries.all');
    Route::get('/queries/create', [QueryController::class, 'create'])->name('queries.create');
    Route::get('/queries/{query}', [QueryController::class, 'show'])->name('queries.show');
    Route::get('/queries/{query}/edit', [QueryController::class, 'edit'])->name('queries.edit');
    Route::post('/queries', [QueryController::class, 'store'])->name('queries.store');
    Route::put('/queries/{query}',[QueryController::class,'update'])->name('queries.update');

});
