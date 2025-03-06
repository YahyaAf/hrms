<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarriereController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HierarchyController;
use App\Http\Controllers\DepartementController;




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
        Route::get('/show/{user_id}', [CarriereController::class, 'show'])->name('show');
        Route::get('/create/{user_id?}', [CarriereController::class, 'create'])->name('create');
        Route::post('/', [CarriereController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CarriereController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CarriereController::class, 'update'])->name('update');
        Route::get('/historique', [CarriereController::class, 'historique'])->name('historique')->middleware('auth');
    });

    Route::get('/historique', [CarriereController::class, 'historique'])->name('carrieres.historique');

    Route::get('/hierarchy', [HierarchyController::class, 'index'])->name('hierarchy.index');

    Route::prefix('conges')->name('conges.')->group(function () {
        Route::get('/solde', [CongeController::class, 'soldeConges'])->name('solde'); 
        Route::get('/', [CongeController::class, 'index'])->name('index');
        Route::get('/create', [CongeController::class, 'create'])->name('create');
        Route::post('/', [CongeController::class, 'store'])->name('store');
        Route::get('/{id}', [CongeController::class, 'show'])->name('show');
        Route::get('/conges/gestion', [CongeController::class, 'gestionConges'])->name('gestion');
        Route::post('/conges/{id}/validate-manager', [CongeController::class, 'validateManager'])->name('validateManager');
        Route::post('/conges/{id}/validate-rh', [CongeController::class, 'validateRh'])->name('validateRh');
        Route::post('/conges/{id}/reject-manager', [CongeController::class, 'rejectManager'])->name('rejectManager');
        Route::post('/conges/{id}/reject-rh', [CongeController::class, 'rejectRh'])->name('rejectRh');


    });
    
    


});

require __DIR__.'/auth.php';
