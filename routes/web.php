<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\EnfermeraController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use App\Models\Enfermera;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role == 'Administrador') {
        $admin = new AdministradorController;

        $medicos = $admin->conteoMedicos();
        $enfermeras = $admin->conteoEnfermeras();
        $pacientes = $admin->conteoPacientes();

        return view('dashboard', compact('medicos', 'enfermeras', 'pacientes'));
    }

    if (Auth::user()->role == 'Medico') {
        $medico = new MedicoController;
        $citasTotales = $medico->conteoCitas();
        $citasPendientes = $medico->citasPendientes();
        $citasFinalizadas = $medico->citasFinalizadas();

        return view('dashboard', compact('citasTotales', 'citasPendientes', 'citasFinalizadas'));
    }

    if (Auth::user()->role == 'Enfermera') {
        $enfermera = new EnfermeraController;
        $tratamientos = $enfermera->countTratamientos();
        $medicinas = $enfermera->countMedicinas();

        return view('dashboard', compact('tratamientos', 'medicinas'));
    }

    if (Auth::user()->role == 'Paciente') {
        $paciente = new PacienteController;
        $citasTotales = $paciente->countCitasTotales();
        $citaPendientes = $paciente->countCitasPendientes();

        return view('dashboard', compact('citasTotales', 'citaPendientes'));
    }

    

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Aqui se registran las rutas para el administrador poner el rol de administrador, lo mismo para el medico y el paciente y el rol de enfermera
Route::middleware('auth', 'role:Administrador')->group(function () {
    Route::get('/registrarMedico', [AdministradorController::class, 'registrarMedico'])->name('registrarMedico');
    Route::post('/registrarMedico', [AdministradorController::class, 'crearMedico'])->name('crearMedico');
    Route::get('/registrarEnfermera', [AdministradorController::class, 'registrarEnfermera'])->name('registrarEnfermera');
    Route::post('/registrarEnfermera', [AdministradorController::class, 'crearEnfermera'])->name('crearEnfermera');
    Route::get('/registrarEspecialidad', [AdministradorController::class, 'mostrarregistrarEspecialidad'])->name('registrarEspecialidad');
    Route::post('/registrarEspecialidad', [AdministradorController::class, 'crearEspecialidad'])->name('crearEspecialidad');
    Route::delete('/eliminarEspecialidad/{id}', [AdministradorController::class, 'destroyEspecialidad'])->name('destroyEspecialidad');
    Route::post('/editarEspecialidad', [AdministradorController::class, 'actualizarEspecialidad'])->name('editarEspecialidad');
    Route::get('/reportes', [AdministradorController::class, 'reportesShow'])->name('reportes');
    Route::get('/exportar-citas', [AdministradorController::class, 'export'])->name('exportar');
});


Route::middleware('auth', 'role:Paciente')->group(function () {
    Route::get('/medicos-por-especialidad/{id}', [PacienteController::class, 'porEspecialidad']);
    Route::get('/dias-por-medico/{id}', [PacienteController::class, 'porDias']);
    Route::get('/horas-por-medico/{id}', [PacienteController::class, 'porHoras']);
    Route::get('/citas-por-medico/{id}/{fecha}', [PacienteController::class, 'citasPorMedico']);
    Route::get('/agendarCita', [PacienteController::class, 'mostrarAgendarCita'])->name('agendarCita');
    Route::post('/agendarCita', [PacienteController::class, 'agendarCita'])->name('agendarCita');
});


Route::middleware('auth', 'role:Medico')->group(function () {
    Route::get('/citas', [MedicoController::class, 'mostrarcitas'])->name('citas');
    Route::get('/conteo-citas', [MedicoController::class, 'conteoPorFecha']);
    Route::get('/citas-detalle/{estado}/{fecha}', [MedicoController::class, 'detalle']);
    Route::post('/confirmar-cita', [MedicoController::class, 'confirmarCita'])->name('confirmarCita');
    Route::post('/cancelar-cita', [MedicoController::class, 'cancelarCita'])->name('cancelarCita');
    Route::get('/comenzar-cita/{id}', [MedicoController::class, 'comenzarCita'])->name('comenzarCita');
    Route::get('/finalizar-cita', [MedicoController::class, 'finalizarCita'])->name('finalizarCita');
    Route::post('/finalizar-cita/{pacienteId}/{citaId}', [MedicoController::class, 'finalizarCita'])->name('finalizarCita');
});

Route::middleware('auth', 'role:Enfermera')->group(function () {
    Route::get('/tratamientos', [EnfermeraController::class, 'mostrarTratamientos'])->name('tratamientos');
    Route::get('/validarReceta/{id}', [EnfermeraController::class, 'validarReceta'])->name('validarReceta');
    Route::post('/validarReceta/{id}', [EnfermeraController::class, 'validarRecetaPost'])->name('validarRecetaPost');
    Route::get('/medicinas', [EnfermeraController::class, 'mostrarMedicinas'])->name('medicinas');
    Route::post('/registrarMedicina', [EnfermeraController::class, 'registrarMedicina'])->name('registrarMedicina');
    Route::get('/ver-lote/{id}', [EnfermeraController::class, 'verLote'])->name('ver-lote');
    Route::post('/registrarLote/{id}', [EnfermeraController::class, 'registrarLote'])->name('registrarLote');
    Route::get('/suministrarReceta/{id}', [EnfermeraController::class, 'suministrarReceta'])->name('suministrarReceta');
    Route::post('medicamento-suministrar/{id}', [EnfermeraController::class, 'suministrarMedicamento'])->name('suministrarMedicamento');
});


require __DIR__ . '/auth.php';
