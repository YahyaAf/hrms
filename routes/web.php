<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\CarriereController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('departements',DepartementController::class);
    Route::resource('emplois',EmploiController::class);
    Route::resource('contracts', ContractController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('users', UserController::class);
    Route::get('/get-emplois/{departement_id}', [UserController::class, 'getEmplois']);
    Route::resource('formations', FormationController::class);
    

    Route::get('/carrieres', [CarriereController::class, 'index'])->name('carrieres.index');
    Route::get('/carrieres/{id}', [CarriereController::class, 'show'])->name('carrieres.show');
    Route::get('/carrieres/{user_id}/edit', [CarriereController::class, 'edit'])->name('carrieres.edit');
    Route::put('/carrieres/{user_id}', [CarriereController::class, 'update'])->name('carrieres.update');


});

require __DIR__.'/auth.php';
