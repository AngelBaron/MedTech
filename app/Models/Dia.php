<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    protected $fillable = [
        'nombre',
    ];

    //timestamps false
    public $timestamps = false;

    public function medico_dia()
    {
        return $this->hasMany(Medico_dia::class);
    }
}
