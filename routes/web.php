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
        try {
            \DB::connection('qsimple')->getPdo();
            $data='Connected';
        }
        catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e->getMessage() );
        }

    
        return Inertia::render('Dashboard', [
            'db_connect' => $data,
        ]);
    })->name('dashboard');

    /** Database routes **/

    Route::get('/databases', [DatabaseController::class, 'index'])->name('databases.all');
    //Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    //Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::get('/databases/create', [DatabaseController::class, 'create'])->name('databases.create');
    Route::post('/databases', [DatabaseController::class, 'store'])->name('databases.store');
    //Route::put('/projects/{project}',[ProjectController::class,'update'])->name('projects.update');
    //Route::delete('/projects/{project}',[ProjectController::class,'destroy'])->name('projects.destroy');

    Route::get('/querys',[QueryController::class, 'executeQuery'])->name('query.exe');


});
