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
use App\Http\Controllers\HierarchyController;



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
    

    Route::prefix('carrieres')->name('carrieres.')->group(function () {
        Route::get('/', [CarriereController::class, 'index'])->name('index');
        Route::get('/{id}', [CarriereController::class, 'show'])->name('show');
        Route::get('/{user_id}/edit', [CarriereController::class, 'edit'])->name('edit');
        Route::put('/{user_id}', [CarriereController::class, 'update'])->name('update');
    });

    Route::get('/hierarchy', [HierarchyController::class, 'index'])->name('hierarchy.index');


});

require __DIR__.'/auth.php';
