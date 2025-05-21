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
        $medicinas = Medicamento::all();
        return view('enfermera.medicinas', compact('medicinas'));
    }


    public function validarReceta($id){
        $tratamiento = Tratamiento::find($id);
        $archivo = Archivo::with('receta')->where('tratamiento_id', $id)->first();

        return view('enfermera.validarReceta', compact('tratamiento','archivo'));
    }

    public function registrarMedicina(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'via' => 'required|string|in:Oral,Sublingual,Rectal,Intravenosa,Intramuscular,Subcutánea,Tópica,Inhalatoria,Transdérmica,Vaginal,Intratecal,Intraauricular,Intraocular,Intraarterial,Epidural,Intranasal,Intraperitoneal',
            'concentracion' => 'required|string|max:255',
            'presentacion' => 'required|string|max:255',
        ]
        );

        Medicamento::create([
            'nombre'=>$request->name,
            'descripcion'=>$request->descripcion,
            'presentacion'=>$request->presentacion,
            'concentracion'=>$request->concentracion,
            'via_administracion'=>$request->via,
        ]);

        return redirect()->route('medicinas')->with('success', 'Medicamento registrado correctamente');
        
    }
}
