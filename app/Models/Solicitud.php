<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidato_id',
        'tipo_estudio_id',
        'estado',
        'fecha_solicitud',
        'fecha_completado',
    ];

    protected $table = 'solicitudes';

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }

    public function tipoEstudio()
    {
        return $this->belongsTo(TipoEstudio::class);
    }
}
