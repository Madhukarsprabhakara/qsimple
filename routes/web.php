<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
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
        \Config::set(['database.connections.qsimple' => [
        'driver'    => 'pgsql',
        'host'      => 'localhost',
        'port'      => '5432',
        'database'  => 'qsimple',
        'username'  => 'postgres',
        'password'  => 'Thankingli07*',
        ]]);
        //\DB::connection('testDB')->table('some_tables');
        $data=\DB::connection('qsimple')->select('select * from users');

    
        return Inertia::render('Dashboard', [
            'db_connect' => $data,
        ]);
    })->name('dashboard');
});
