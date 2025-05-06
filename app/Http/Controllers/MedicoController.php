<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function mostrarCitas()
    {
        return view('medico.citas');
    }

    
}
