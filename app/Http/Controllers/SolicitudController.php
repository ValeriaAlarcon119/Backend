<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index(Request $request)
    {
        $query = Solicitud::query();

        if ($request->has('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        if ($request->has('tipo_estudio_id')) {
            $query->where('tipo_estudio_id', $request->input('tipo_estudio_id'));
        }

        return $query->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_estudio_id' => 'required|exists:tipo_estudios,id',
            'estado' => 'required|string|max:255',
        ]);

        $solicitud = Solicitud::create($request->all());
        return response()->json($solicitud, 201);
    }

    public function show($id)
    {
        return Solicitud::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update($request->all());
        return response()->json($solicitud, 200);
    }

    public function destroy($id)
    {
        Solicitud::destroy($id);
        return response()->json(null, 204);
    }

    public function cambiarEstado(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = $request->input('estado');
        $solicitud->save();
        return response()->json($solicitud, 200);
    }
}
