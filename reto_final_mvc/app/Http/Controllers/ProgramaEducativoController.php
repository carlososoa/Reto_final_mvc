<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\ProgramaEducativo;
use Illuminate\Http\Request;


class ProgramaEducativoController extends Controller
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
        // Obtener todos los registros de ProgramaEducativo
        $programas = ProgramaEducativo::all();
        return response()->json($programas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear un nuevo programa educativo
        $programa = ProgramaEducativo::create([
            'nombre' => $request->input('nombre')
        ]);
        return response()->json($programa, 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener un programa educativo por su ID
        $programa = ProgramaEducativo::find($id);
        
        if ($programa) {
            return response()->json($programa);
        } else {
            return response()->json(['error' => 'Programa educativo no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Actualizar un programa educativo por su ID
        $programa = ProgramaEducativo::find($id);

        if ($programa) {
            $programa->nombre = $request->input('nombre');
            $programa->save();
            return response()->json([$programa, 'message'=>"Actualizado Correctamente"]);
        } else {
            return response()->json(['error' => 'Programa educativo no encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Eliminar un programa educativo por su ID
        $programa = ProgramaEducativo::find($id);

        if ($programa) {
            $programa->delete();
            return response()->json(['message' => 'Programa educativo eliminado']);
        } else {
            return response()->json(['error' => 'Programa educativo no encontrado'], 404);
        }
    }
}
