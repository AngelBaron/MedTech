<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento_medicamento extends Model
{
    protected $fillable = [
        'tratamiento_id',
        'medicamento_id',
        'dosis',
        'frecuencia',
        'duracion_dias',
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
