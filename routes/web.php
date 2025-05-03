<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ProfileController;
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
});


//Aqui se registran las rutas para el administrador poner el rol de administrador, lo mismo para el medico y el paciente y el rol de enfermera
Route::middleware('auth','role:Administrador')->group(function () {
    Route::get('/registrarMedico', [AdministradorController::class,'registrarMedico'])->name('registrarMedico');
    Route::post('/registrarMedico', [AdministradorController::class,'crearMedico'])->name('crearMedico');
    Route::get('/registrarEnfermera', [AdministradorController::class,'registrarEnfermera'])->name('registrarEnfermera');
    Route::post('/registrarEnfermera', [AdministradorController::class,'crearEnfermera'])->name('crearEnfermera');
});


require __DIR__.'/auth.php';
