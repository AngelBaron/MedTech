<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'presentacion',
        'concentracion',
        'via_administracion'
    ];



    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }
}
