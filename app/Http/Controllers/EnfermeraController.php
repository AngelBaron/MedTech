<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Medicamento;
use App\Models\Receta;
use App\Models\Tratamiento;
use Illuminate\Http\Request;

class EnfermeraController extends Controller
{
    public function mostrarTratamientos(){
        $tratamientos = Tratamiento::all();
        return view('enfermera.tratamientos', compact('tratamientos'));
    }

    public function mostrarMedicinas(){
        $medicinas = Medicamento::with('lotes')->get();
        return view('enfermera.medicinas', compact('medicinas'));
    }


    public function validarReceta($id){
        $tratamiento = Tratamiento::find($id);
        $archivo = Archivo::with('receta')->where('tratamiento_id', $id)->first();

        return view('enfermera.validarReceta', compact('tratamiento','archivo'));
    }
}
