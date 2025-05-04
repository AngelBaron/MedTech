<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico_horario extends Model
{
    protected $fillable = [
        'medico_id',
        'horario_inicio',
        'horario_fin',
    ];

    //timestamps false
    public $timestamps = false;

    public function medicos()
    {
        return $this->belongsTo(Medico::class);
    }
}
