<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $fillable = [
        'user_id',

    ];

    //timestamps false
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
