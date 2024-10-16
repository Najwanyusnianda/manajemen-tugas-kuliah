<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\Auth\LoginController;

// Route to show the login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route to handle the login form submission
Route::post('/login', [LoginController::class, 'login']);

// Route to handle logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
   // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});




// PROJECTS ROUTES
Route::prefix('projects')->group(function (){
    Route::post('insert', [ProjectsController::class, 'insert'])->name('projects.insert');
    Route::post('update/{id}', [ProjectsController::class, 'update'])->name('projects.update');
    Route::get('delete/{id}', [ProjectsController::class, 'delete'])->name('projects.delete');
});

// TASKS ROUTES
Route::prefix('tasks')->group(function (){
    Route::post('insert', [TasksController::class, 'insert'])->name('tasks.insert');
    Route::post('update/{id}', [TasksController::class, 'update'])->name('tasks.update');
    Route::get('delete/{id}', [TasksController::class, 'delete'])->name('tasks.delete');
    Route::post('toggle-completion/{id?}', [TasksController::class, 'toggleCompletion'])->name('tasks.toggleCompletion');
    Route::get('filter', [TasksController::class, 'filter'])->name('tasks.filter');
    Route::post('update-priority', [TasksController::class, 'updatePriority'])->name('tasks.updatePriority');
});
