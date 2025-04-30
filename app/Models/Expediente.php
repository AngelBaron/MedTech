<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $fillable = [
        'paciente_id',

    ];

    //timestamps false
    public $timestamps = false;

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

   
}
