<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\WikiAf5Projects;
use App\Http\Controllers\WikiAf5ProjectsController;
use App\Http\Controllers\WikiAf5CompanyController;
use App\Http\Controllers\WikiAf5ProjectsHistoryController;
use App\Http\Controllers\WikiAf5ProjectNotesController;
use App\Http\Controllers\WikiAf5ProjectsEnviromentsController;
use App\Http\Controllers\WikiAf5WebServicesController;
use App\Http\Controllers\WikiAf5ProjectIncidencesController;


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

Route::resource('projects', WikiAf5ProjectsController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::resource('projects/{project}/history', WikiAf5ProjectsHistoryController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::resource('projects/{project}/notes', WikiAf5ProjectNotesController::class)
    ->middleware(['auth:sanctum', 'verified']);

Route::resource('projects/{project}/incidences', WikiAf5ProjectIncidencesController::class)
    ->middleware(['auth:sanctum', 'verified']);
    
Route::resource('projects/{project}/web-services', WikiAf5WebServicesController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::resource('projects/{project}/enviroments', WikiAf5ProjectsEnviromentsController::class)
    ->middleware(['auth:sanctum', 'verified']); 

// Route::resource('projects/{project}/enviroments', WikiAf5ProjectsEnviromentsController::class)
//     ->middleware(['auth:sanctum', 'verified']); 

Route::get('projects', [WikiAf5ProjectsController::class, 'index'])
    ->name('projects')
    ->middleware(['auth:sanctum', 'verified']);

// Route::get('/projects/{id}', [WikiAf5ProjectsController::class, 'show'])
//     ->name('projects/{id}')
//     ->middleware(['auth:sanctum', 'verified']);

// Route::get('/projects/{id}/edit', [WikiAf5ProjectsController::class, 'edit'])
//     ->name('projects/{id}/edit')
//     ->middleware(['auth:sanctum', 'verified']);

