<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'paciente_id',
        'medico_id',
        'recetatxt',
        
    ];

    //timestamps false
    public $timestamps = false;

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    
}
