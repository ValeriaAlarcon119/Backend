<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    public function index()
    {
        $candidatos = Candidato::all();
        return response()->json($candidatos, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'documento_identidad' => 'required|numeric|unique:candidatos,documento_identidad',
            'correo' => 'required|email|unique:candidatos,correo',
            'telefono' => 'required|string|max:15',
        ]);

        $candidato = Candidato::create($request->all());

        return response()->json(['message' => 'Candidato creado con éxito', 'candidato' => $candidato], 201);
    }

    public function show($id)
    {
        return Candidato::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $candidato = Candidato::findOrFail($id);
        $candidato->update($request->all());
        return response()->json($candidato, 200);
    }

    public function destroy($id)
    {
        $candidato = Candidato::findOrFail($id);

        // Verificar si el candidato tiene solicitudes asociadas
        if ($candidato->solicitudes()->count() > 0) {
            return response()->json(['message' => 'Este candidato está en uso en la aplicación.'], 422);
        }

        $candidato->delete();
        return response()->json(['message' => 'Candidato eliminado con éxito.']);
    }
}