<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\SecretariaController;


Route::get('/', function () {
    return view('modulos.seleccionar');
});

Route::get('/ingresar', function () {
    return view('modulos.ingresar');
});

Route::get('/inicio', [InicioController::class, 'index']);
Route::get('/mis-datos', [InicioController::class, 'DatosCreate']);
Route::put('/mis-datos', [InicioController::class, 'DatosUpdate']);
Route::get('/inicio-editar', [InicioController::class, 'edit']);
Route::put('/inicio-editar', [InicioController::class, 'update']);

Auth::routes();


Route::get('/consultorios', [ConsultorioController::class, 'index']);
Route::post('/consultorios', [ConsultorioController::class, 'store']);
Route::put('/consultorio/{id}', [ConsultorioController::class, 'update']);
Route::delete('/borrar-consultorio/{id}', [ConsultorioController::class, 'destroy']);

// Ver Consultorios como paciente
Route::get('ver-consultorios', [ConsultorioController::class, 'VerConsultorios']);


Route::get('/doctores', [DoctorController::class, 'index']);
Route::post('/doctores', [DoctorController::class, 'store']);
Route::get('/eliminar-doctor/{id}', [DoctorController::class, 'destroy']);

// Ver Doctores como paciente
Route::get('/ver-doctores/{id}', [DoctorController::class, 'VerDoctores']);


Route::get('/pacientes', [PacienteController::class, 'index']);
Route::get('/crear-paciente', [PacienteController::class, 'create']);
Route::post('/crear-paciente', [PacienteController::class, 'store']);
Route::get('/editar-paciente/{id}', [PacienteController::class, 'edit']);
Route::put('actualizar-paciente/{paciente}', [PacienteController::class, 'update']);
Route::get('eliminar-paciente/{id}', [PacienteController::class, 'destroy']);

Route::get('/citas/{id}', [CitaController::class, 'index']);
Route::post('/horario/', [CitaController::class, 'HorarioDoctor']);
Route::put('/editar-horario/{id}', [CitaController::class, 'EditarHorario']);
Route::post('/citas/{id_doctor}', [CitaController::class, 'CrearCita']);
Route::delete('/borrar-cita/', [CitaController::class, 'destroy']);

// Historial de citas

Route::get('/historial/', [CitaController::class, 'historial']);

Route::get('secretarias', [SecretariaController::class, 'index']);
Route::post('secretarias', [SecretariaController::class, 'store']);
Route::get('eliminar-secretaria/{id}', [SecretariaController::class, 'destroy']);
Route::get('editar-secretaria/{id}', [SecretariaController::class, 'show']);
Route::put('actualizar-secretaria/{id}', [SecretariaController::class, 'update']);