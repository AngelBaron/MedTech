<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    public function mostrarCitas()
    {
        return view('medico.citas');
    }

    public function comenzarCita($id)
    {
        $cita = Cita::find($id);
        $paciente = Paciente::where('id', $cita->paciente_id)->with('user')->first();
        if ($cita->estado == 'confirmada'||$cita->estado == 'en curso'||$cita->estado == 'curso') {
            $cita->estado = 'curso';
            $cita->save();
        } 
        return view('medico.CitaInicio', compact('cita','paciente'));
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

    public function confirmarCita(Request $request)
    {
        $cita = Cita::where('paciente_id', $request->pacienteId)->where('fecha',$request->fecha)->where('hora', $request->hora)->first();
        if ($cita) {
            $cita->estado = 'confirmada';
            $cita->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cita no encontrada']);
        }
    }


    public function cancelarCita(Request $request)
    {
        $cita = Cita::find($request->citaId);
        if ($cita) {
            $cita->estado = 'cancelada';
            $cita->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cita no encontrada']);
        }
    }
    
}
