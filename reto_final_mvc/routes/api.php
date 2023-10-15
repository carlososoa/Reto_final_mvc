<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramaEducativoController;
use App\Http\Controllers\DocentesController;
use App\Http\Controllers\AsignaturasController;
use App\Http\Controllers\ProgramaEducativoAsignaturaController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('auth/register',[AuthController::class,'create']);
Route::post('auth/login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('programas-educativos', ProgramaEducativoController::class);
    Route::resource('docentes', DocentesController::class);
    Route::resource('asignaturas', AsignaturasController::class);
    Route::get('programa-educativo/{idPrograma}/asignaturas', [ProgramaEducativoAsignaturaController::class, 'obtenerAsignaturasPorProgramaEducativo']);
    Route::get('auth/logout',[AuthController::class,'logout']);
    
});
