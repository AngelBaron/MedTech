<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'user_id',
        
    ];

    //timestamps false
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
