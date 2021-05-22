<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\WikiAf5ProjectsController;
use App\Http\Controllers\WikiAf5ProjectsHistoryController;
use App\Http\Controllers\WikiAf5ProjectNotesController;
use App\Http\Controllers\WikiAf5ProjectIncidencesController;
use App\Http\Controllers\WikiAf5ProjectsEnviromentsController;
use App\Http\Controllers\WikiAf5ProjectsGitController;
use App\Http\Controllers\WikiAf5ProjectsTrelloController;
use App\Http\Controllers\WikiAf5ProjectsPhaseController;
use App\Http\Controllers\WikiAf5PatternWorksController;
use App\Http\Controllers\WikiAf5WebServicesController;
use App\Http\Controllers\WikiAf5MeetingsController;
use App\Http\Controllers\WikiAf5MeetingsLogsController;
use App\Http\Controllers\WikiAf5MeetingsNotesController;
use App\Http\Controllers\WikiAf5MeetingsUsersController;
use App\Http\Controllers\WikiAf5ReportsController;
use App\Http\Controllers\WikiAf5CompanyController;
use App\Http\Controllers\WikiAf5ContactController;
use App\Http\Controllers\WikiAf5ClientsController;
use App\Http\Controllers\WikiAf5ExternalWorkersController;
use App\Http\Controllers\WikiAf5EmployeesNotesController;
use App\Http\Controllers\WikiAf5RolesController;
use App\Http\Controllers\WikiAf5PermissionsController;



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

/** Users **/
Route::resource('wikiusers', UsersController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('wikiusers', [UsersController::class, 'index'])
    ->name('wikiusers')
    ->middleware(['auth:sanctum', 'verified']);


/** Projects **/

Route::get('/projects/data', [WikiAf5ProjectsController::class, 'data'])
    ->name('projects.data')
    ->middleware(['auth:sanctum', 'verified']);

Route::resource('projects', WikiAf5ProjectsController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('projects', [WikiAf5ProjectsController::class, 'index'])
    ->name('projects')
    ->middleware(['auth:sanctum', 'verified']);

    /* Projects History */

Route::resource('projects/{project}/history', WikiAf5ProjectsHistoryController::class)
    ->middleware(['auth:sanctum', 'verified']);
    
    /* Projects Notes */

Route::resource('projects/{project}/notes', WikiAf5ProjectNotesController::class)
    ->middleware(['auth:sanctum', 'verified']);

    /* Projects Incidences */

Route::resource('projects/{project}/incidences', WikiAf5ProjectIncidencesController::class)
    ->middleware(['auth:sanctum', 'verified']);
    
    /* Projects Web Services */

Route::resource('projects/{project}/webservices', WikiAf5WebServicesController::class)
    ->middleware(['auth:sanctum', 'verified']);
    
    /* Projects Enviroments */

Route::resource('projects/{project}/enviroments', WikiAf5ProjectsEnviromentsController::class)
    ->middleware(['auth:sanctum', 'verified']);

    /* Projects GIT */

Route::resource('projects/{project}/enviroments/{enviroment}/git', WikiAf5ProjectsGitController::class)
    ->middleware(['auth:sanctum', 'verified']);

        /* Projects Trello */

Route::resource('projects/{project}/enviroments/{enviroment}/trello', WikiAf5ProjectsTrelloController::class)
    ->middleware(['auth:sanctum', 'verified']);

       /* Projects Phase */

Route::resource('projects/{project}/enviroments/{enviroment}/phase', WikiAf5ProjectsPhaseController::class)
    ->middleware(['auth:sanctum', 'verified']);


/** Meetings **/

Route::get('/meetings/data', [WikiAf5MeetingsController::class, 'data'])
    ->name('meetings.data')
    ->middleware(['auth:sanctum', 'verified']);

Route::resource('meetings', WikiAf5MeetingsController::class)
    ->middleware(['auth:sanctum', 'verified']);
    
Route::get('meetings', [WikiAf5MeetingsController::class, 'index'])
    ->name('meetings')
    ->middleware(['auth:sanctum', 'verified']);

    /* Meetings Logs */

Route::resource('meetings/{meeting}/logs', WikiAf5MeetingsLogsController::class)
    ->middleware(['auth:sanctum', 'verified']);

    /* Meetings Users */

// Route::get('meetingusers.create', function () {
//     inertia()->modal('meetingusers.create');
    
//     return inertia('meetings.edit');
// });
// Route::resource('meetings/{meeting}/meetingusers', WikiAf5MeetingsUsersController::class)
//     ->middleware(['auth:sanctum', 'verified']);

     /* Meetings Notes */

Route::resource('meetings/{meeting}/meetingnotes', WikiAf5MeetingsNotesController::class)
    ->middleware(['auth:sanctum', 'verified']);

    /* Meetings Reports */

Route::resource('meetings/{meeting}/reports', WikiAf5ReportsController::class)
    ->middleware(['auth:sanctum', 'verified']);


/** Employees **/

Route::resource('personalnotes', WikiAf5EmployeesNotesController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('personalnotes', [WikiAf5EmployeesNotesController::class, 'index'])
    ->name('personalnotes')
    ->middleware(['auth:sanctum', 'verified']);


/** Companies **/

Route::resource('companies', WikiAf5CompanyController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('companies', [WikiAf5CompanyController::class, 'index'])
    ->name('companies')
    ->middleware(['auth:sanctum', 'verified']);

/** Contacts **/

Route::resource('contacts', WikiAf5ContactController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('contacts', [WikiAf5ContactController::class, 'index'])
    ->name('contacts')
    ->middleware(['auth:sanctum', 'verified']);

/** Clients **/

Route::resource('clients', WikiAf5ClientsController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('clients', [WikiAf5ClientsController::class, 'index'])
    ->name('clients')
    ->middleware(['auth:sanctum', 'verified']);

/** External Workers **/

Route::resource('externalworkers', WikiAf5ExternalWorkersController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('externalworkers', [WikiAf5ExternalWorkersController::class, 'index'])
    ->name('externalworkers')
    ->middleware(['auth:sanctum', 'verified']);

/** Pattern Works **/

Route::resource('patternworks', WikiAf5PatternWorksController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('patternworks', [WikiAf5PatternWorksController::class, 'index'])
    ->name('patternworks')
    ->middleware(['auth:sanctum', 'verified']);

/** Roles **/

Route::get('/roles/datausers', [WikiAf5RolesController::class, 'datausers'])
    ->name('roles.datausers')
    ->middleware(['auth:sanctum', 'verified']);

Route::get('/roles/datapermissions', [WikiAf5RolesController::class, 'datapermissions'])
    ->name('roles.datapermissions')
    ->middleware(['auth:sanctum', 'verified']);

Route::get('/roles/{role}/editusers', [WikiAf5RolesController::class, 'editusers'])
    ->name('roles.editusers')
    ->middleware(['auth:sanctum', 'verified']);

Route::get('/roles/{role}/editpermissions', [WikiAf5RolesController::class, 'editpermissions'])
    ->name('roles.editpermissions')
    ->middleware(['auth:sanctum', 'verified']);

Route::put('/roles/{role}/updateusers', [WikiAf5RolesController::class, 'updateusers'])
    ->name('roles.updateusers')
    ->middleware(['auth:sanctum', 'verified']);

Route::put('/roles/{role}/updatepermissions', [WikiAf5RolesController::class, 'updatepermissions'])
    ->name('roles.updatepermissions')
    ->middleware(['auth:sanctum', 'verified']);

Route::resource('roles', WikiAf5RolesController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('roles', [WikiAf5RolesController::class, 'index'])
    ->name('roles')
    ->middleware(['auth:sanctum', 'verified']);

/** Permissions **/

Route::resource('permissions', WikiAf5PermissionsController::class)
    ->middleware(['auth:sanctum', 'verified']); 

Route::get('permissions', [WikiAf5PermissionsController::class, 'index'])
    ->name('permissions')
    ->middleware(['auth:sanctum', 'verified']);
