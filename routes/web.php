<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\WikiAf5Projects;
use App\Http\Controllers\WikiAf5ProjectsController;

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


Route::resource('WikiAf5Projects', 'WikiAf5ProjectsController');
// Ruta acceso Controller de revisiones:
Route::resource('Projects', WikiAf5ProjectsController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/clients', function () {
    return Inertia::render('Clients');
})->name('clients');

Route::middleware(['auth:sanctum', 'verified'])->get('/externalworkers', function () {
    return Inertia::render('ExternalWorkers');
})->name('externalworkers');

Route::middleware(['auth:sanctum', 'verified'])->get('/externalworkers', function () {
    return Inertia::render('ExternalWorkers');
})->name('externalworkers');

Route::middleware(['auth:sanctum', 'verified'])->get('/meetings', function () {
    return Inertia::render('Meetings');
})->name('meetings');

Route::middleware(['auth:sanctum', 'verified'])->get('/personalnotes', function () {
    return Inertia::render('PersonalNotes');
})->name('personalnotes');


/** Projects **/

Route::get('projects', [WikiAf5ProjectsController::class, 'index'])
    ->name('projects')
    ->middleware(['auth:sanctum', 'verified']);
