<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    
    protected $fillable = [
        'paciente_id',
        'medico_id',
        'diagnostico',
        'indicaciones',
        'fecha_inicio',
        'fecha_fin',
    ];

    //timestamps false
    public $timestamps = false;

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    
}
