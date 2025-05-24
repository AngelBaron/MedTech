<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento_medicamento extends Model
{
    protected $fillable = [
        'tratamiento_id',
        'medicamento_id',
        'dosis',
        'horas',
        'frecuencia',
        'duracion_dias',
        'estado'
    ];

    //timestamps false
    public $timestamps = false;

    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class);
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
}
