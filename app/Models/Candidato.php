<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'documento_identidad',
        'correo',
        'telefono',
    ];

    // Definir la relación con Solicitud
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}
