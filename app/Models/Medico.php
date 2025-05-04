<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    //
    protected $fillable = [
        'user_id',
        'especialidad',
        'cedula',
    ];

    //timestamps false
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Medico_dias()
    {
        return $this->hasMany(Medico_dia::class);
    }

    public function Medico_horarios()
    {
        return $this->hasMany(Medico_horario::class);
    }

    public function Medico_especialidads()
    {
        return $this->hasMany(Medico_especialidad::class);
    }
    
    
}
