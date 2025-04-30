<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $fillable = [
        'numero_lote',
        'fecha_vencimiento',
        'cantidad',
        'medicamento_id',
    ];

    //timestamps false
    public $timestamps = false;

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
}
