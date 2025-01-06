<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/about','about');

//Routing for admin:
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AdminController::class, 'register']);
        Route::get('login',[AdminController::class,'showLoginForms'])->name('login');
        Route::post('login', [AdminController::class, 'login'])->name('login.submit');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        
        Route::middleware('auth:admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/users',[AdminController::class, 'viewAllUsers'])->name('users');
            Route::get('/users/{id}/todos', [AdminController::class, 'viewUserTodos'])->name('user.todos');
            Route::get('/profile',[AdminController::class,'showProfile'])->name('profile');
            Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
            Route::post('/profile',[AdminController::class,'updateProfile'])->name('profile.update');
            Route::delete('/users/{user}',[AdminController::class,'destroy'])->name('user.destroy');
        });
    });
//Routing for applicant:
    Route::prefix('applicant')->name('applicant.')->group(function () {
        Route::get('/register', [ApplicantController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [ApplicantController::class, 'register'])->name('register.submit');
        Route::get('login', [ApplicantController::class, 'showLoginForm'])->name('login');
        Route::post('login', [ApplicantController::class, 'login'])->name('login.submit');
        Route::middleware('auth:applicant')->get('/dashboard', [ApplicantController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [ApplicantController::class, 'logout'])->name('logout');
});

//Routing for profile:
    Route::middleware('auth:applicant')->prefix('applicant')->name('applicant.')->group(function(){
        Route::get('/profile',[ProfileController::class,'show'])->name('profile');
        Route::post('/profile',[ProfileController::class,'update'])->name('profile.update');
    });

//Routing for todo:
    Route::middleware('auth:applicant')->group(function() {
        Route::get('/todos', [TodoController::class, 'index'])->name('applicant.todos.index');
        Route::get('/todos/create', [TodoController::class, 'create'])->name('applicant.todos.create');
        Route::post('/todos', [TodoController::class, 'store'])->name('applicant.todos.store');
        Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('applicant.todos.edit');
        Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('applicant.todos.update');
        Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('applicant.todos.destroy');
        Route::patch('/todos/{todo}/complete', [TodoController::class, 'complete'])->name('applicant.todos.complete');
        Route::delete('/todos/{todo}/remove-completed', [TodoController::class, 'removeCompleted'])->name('applicant.todos.removeCompleted');
        Route::get('/profile', [ProfileController::class, 'show'])->name('applicant.profile');
        Route::post('/logout', [ApplicantController::class, 'logout'])->name('applicant.logout');
    });
    
    Route::get('login', [ApplicantController::class, 'showLoginForm'])->name('login');
