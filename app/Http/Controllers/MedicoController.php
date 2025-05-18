<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Cita;
use App\Models\Expediente;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Receta;
use App\Models\Tratamiento;
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
        if ($cita->estado == 'confirmada' || $cita->estado == 'en curso' || $cita->estado == 'curso') {
            $cita->estado = 'curso';
            $cita->save();
        }
        return view('medico.CitaInicio', compact('cita', 'paciente'));
    }

    public function finalizarCita(Request $request, $paciente, $cita)
    {
        $request->validate([
            'observaciones' => 'required',
            'estado' => 'required', 

            'diagnostico' => function ($attribute, $value, $fail) use ($request) {
                if ($request->estado === 'true' && empty($value)) {
                    $fail('El diagnóstico es obligatorio cuando se requiere tratamiento.');
                }
            },

            'indicaciones' => function ($attribute, $value, $fail) use ($request) {
                if ($request->estado === 'true' && empty($value)) {
                    $fail('Las indicaciones son obligatorias cuando se requiere tratamiento.');
                }
            },

            'inicioFecha' => function ($attribute, $value, $fail) use ($request) {
                if ($request->estado === 'true' && empty($value)) {
                    $fail('La fecha inicial es obligatoria cuando se requiere tratamiento.');
                }
            },

            'finFecha' => function ($attribute, $value, $fail) use ($request) {
                if ($request->estado === 'true' && empty($value)) {
                    $fail('La fecha final es obligatoria cuando se requiere tratamiento.');
                }
            },
        ]);

        
        $cita = Cita::find($cita);
        $paciente = Paciente::where('id', $paciente)->with('user')->first();
        $medico = Medico::where('user_id', Auth::user()->id)->first();
        if ($cita->estado == 'curso') {
            $cita->estado = 'finalizada';
            $cita->save();
        } else {
            return redirect()->route('citas')->with('error', 'La cita no se encuentra en estado de curso');
        }

        $expediente = Expediente::firstOrCreate([
            'paciente_id' => $paciente->id
        ]);

        $receta = Receta::create([
            'medico_id' => $medico->id,
            'paciente_id' => $paciente->id,
            'recetatxt' => $request->receta ?? 'SIN RECETA',
        ]);

        Archivo::create([
            'expediente_id' => $expediente->id,
            'medico_id' => $medico->id,
            'observaciones' => $request->observaciones,
            'receta_id' => $receta->id,
        ]);

        if($request->estado == 'true'){
            Tratamiento::create([
                'medico_id' => $medico->id,
                'paciente_id' => $paciente->id,
                'diagnostico' => $request->diagnostico,
                'indicaciones' => $request->indicaciones,
                'fecha_inicio' => $request->inicioFecha,
                'fecha_fin' => $request->finFecha,
            ]);

            return redirect()->route('citas')->with('success', 'Cita finalizada y tratamiento registrado correctamente');

        }
        return redirect()->route('citas')->with('success', 'Cita finalizada correctamente');
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
        $cita = Cita::where('paciente_id', $request->pacienteId)->where('fecha', $request->fecha)->where('hora', $request->hora)->first();
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
