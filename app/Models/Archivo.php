<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $fillable = [
        'exopediente_id',
        'medico_id',
        'observaciones',
        'receta_id',
    ];



    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
