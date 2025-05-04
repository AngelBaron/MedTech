<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico_especialidad extends Model
{
    protected $fillable = [
        'medico_id',
        'especialidad_id',
    ];

    //timestamps false
    public $timestamps = false;

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
