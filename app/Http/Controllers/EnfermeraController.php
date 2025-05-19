<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use Illuminate\Http\Request;

class EnfermeraController extends Controller
{
    public function mostrarTratamientos(){
        $tratamientos = Tratamiento::all();
        return view('enfermera.tratamientos', compact('tratamientos'));
    }
}
