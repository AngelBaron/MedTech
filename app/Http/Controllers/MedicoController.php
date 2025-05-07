<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    public function mostrarCitas()
    {
        return view('medico.citas');
    }

    public function conteoPorFecha()
    {
        
        $medicoId = Medico::where('user_id', Auth::user()->id)->first()->id;
        $conteo = DB::table('citas')->select('fecha')->selectRaw("SUM(CASE WHEN estado = 'Pendiente' THEN 1 ELSE 0 END) as pendiente")
            ->selectRaw("SUM(CASE WHEN estado = 'confirmada' THEN 1 ELSE 0 END) as confirmada")
            ->selectRaw("SUM(CASE WHEN estado = 'cancelada' THEN 1 ELSE 0 END) as cancelada")
            ->where('medico_id', $medicoId)
            ->groupBy('fecha')
            ->get();
        

        

        // Ejemplo de respuesta JSON
        return response()->json($conteo);
    }


    public function detalle($estado, $fecha)
    {
        $medicoId = Medico::where('user_id', Auth::user()->id)->first()->id;
        $citas = Cita::with('paciente.user')->where('medico_id', $medicoId)
            ->where('estado', $estado)
            ->where('fecha', $fecha)
            ->get();

        return response()->json($citas);
    }

    
}
