<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico_dia extends Model
{
    protected $fillable = [
        'medico_id',
        'dia_id'
    ];

    //timestamps false
    public $timestamps = false;

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function dia()
    {
        return $this->belongsTo(Dia::class);
    }
}
