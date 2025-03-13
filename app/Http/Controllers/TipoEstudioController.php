<?php

namespace App\Http\Controllers;

use App\Models\TipoEstudio;
use Illuminate\Http\Request;
use App\Models\Solicitud;

class TipoEstudioController extends Controller
{
    public function index()
    {
        return TipoEstudio::all();
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        $tipoEstudio = TipoEstudio::create($request->all());

        return response()->json($tipoEstudio, 201);
    }

    public function show($id)
    {
        return TipoEstudio::findOrFail($id);
    }

    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $tipoEstudio = TipoEstudio::findOrFail($id);
        $request->validate(['nombre' => 'required|string|max:255']);
        $tipoEstudio->update($request->all());
        return $tipoEstudio;
    }

  
    public function destroy($id)
    {
        $tipoEstudio = TipoEstudio::findOrFail($id);

        // Verificar si el tipo de estudio tiene solicitudes asociadas
        if ($tipoEstudio->solicitudes()->count() > 0) {
            return response()->json(['message' => 'Este tipo de estudio está en uso en la aplicación.'], 422);
        }

        $tipoEstudio->delete();
        return response()->json(['message' => 'Tipo de estudio eliminado con éxito.']);
    }
}
