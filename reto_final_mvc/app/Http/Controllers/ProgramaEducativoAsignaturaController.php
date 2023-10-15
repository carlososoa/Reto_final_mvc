<?php

namespace App\Http\Controllers;

use App\Models\ProgramaEducativoAsignatura;
use Illuminate\Http\Request;
use App\Models\Asignaturas;
use App\Models\ProgramaEducativo;
use Illuminate\Support\Facades\DB;

class ProgramaEducativoAsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramaEducativoAsignatura $programaEducativoAsignatura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramaEducativoAsignatura $programaEducativoAsignatura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramaEducativoAsignatura $programaEducativoAsignatura)
    {
        //
    }

    public function obtenerAsignaturasPorProgramaEducativo($id)
    {
        // Obtener las asignaturas para el programa educativo dado
        $asignaturas = ProgramaEducativoAsignatura::where('programa_educativo_id', $id)
            ->pluck('asignatura_id');

        // Obtener los nombres de las asignaturas y ordenar por semestre
        $asignaturasConNombres = Asignaturas::whereIn('id', $asignaturas)
            ->orderBy('semestre')
            ->get();

        return $asignaturasConNombres;
    }
}
