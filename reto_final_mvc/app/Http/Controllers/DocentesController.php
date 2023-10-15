<?php

namespace App\Http\Controllers;

use App\Models\Docentes;
use Illuminate\Http\Request;

class DocentesController extends Controller
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
        $docentes = Docentes::all();
        return response()->json($docentes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $docente = Docentes::create([
            'nombre' => $request->input('nombre')
        ]);
        return response()->json($docente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $docente = Docentes::find($id);
        
        if ($docente) {
            return response()->json($docente);
        } else {
            return response()->json(['error' => 'Docente no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $docente = Docentes::find($id);

        if ($docente) {
            $docente->nombre = $request->input('nombre');
            $docente->save();
            return response()->json([$docente,'message' =>'Docente Actualizado']);
        } else {
            return response()->json(['error' => 'Docente no encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $docente = Docentes::find($id);

        if ($docente) {
            $docente->delete();
            return response()->json(['message' => 'Docente eliminado']);
        } else {
            return response()->json(['error' => 'Docente no encontrado'], 404);
        }
    }
}
