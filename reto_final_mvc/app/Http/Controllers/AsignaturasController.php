<?php

namespace App\Http\Controllers;

use App\Models\Asignaturas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AsignaturasController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:index')->only('index');
        $this->middleware('can:store')->only('store');
        $this->middleware('can:show')->only('show');
        $this->middleware('can:update')->only('update');
        $this->middleware('can:destroy')->only('destroy');
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaturas = Asignaturas::all();
        return response()->json($asignaturas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'semestre' => 'required|string',
            'cantidad_de_creditos' => 'required|integer',
            'id_del_docente' => 'required|exists:docentes,id',
            'horas_de_trabajo_autonomo' => 'required|integer',
            'horas_de_trabajo_dirigido' => 'required|integer'
        ]);

        $asignatura = Asignaturas::create($request->all());
        return response()->json([$asignatura, 'message'=>'Creado Correctamente', 201]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asignatura = Asignaturas::find($id);
        
        if ($asignatura) {
            return response()->json($asignatura);
        } else {
            return response()->json(['error' => 'Asignatura no encontrada'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'semestre' => 'required|string',
            'cantidad_de_creditos' => 'required|integer',
            'id_del_docente' => [
                'required',
                'integer',
                Rule::exists('docentes', 'id')->where(function ($query) use ($request) {
                    $query->where('id', $request->id_del_docente);
                })
            ],
            'horas_de_trabajo_autonomo' => 'required|integer',
            'horas_de_trabajo_dirigido' => 'required|integer'
        ]);

        $asignatura = Asignaturas::find($id);

        if ($asignatura) {
            $asignatura->update($request->all());
            return response()->json([$asignatura, 'message'=>'Asignatura Actualizada Correctamente']);
        } else {
            return response()->json(['error' => 'Asignatura no encontrada'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asignatura = Asignaturas::find($id);

        if ($asignatura) {
            $asignatura->delete();
            return response()->json(['message' => 'Asignatura eliminada']);
        } else {
            return response()->json(['error' => 'Asignatura no encontrada'], 404);
        }
    }
}
