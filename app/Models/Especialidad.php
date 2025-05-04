<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $fillable = [
        'nombre',
    ];

    //timestamps false
    public $timestamps = false;

    public function Medico_especialidad()
    {
        return $this->hasMany(Medico_especialidad::class);
    }
}
