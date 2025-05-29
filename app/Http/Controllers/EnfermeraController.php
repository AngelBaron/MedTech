<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Lote;
use App\Models\Medicamento;
use App\Models\Receta;
use App\Models\Tratamiento;
use App\Models\Tratamiento_medicamento;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

use function Pest\Laravel\get;

class EnfermeraController extends Controller
{
    public function mostrarTratamientos()
    {
        $tratamientos = Tratamiento::all();
        $validados = Tratamiento_medicamento::all();
        return view('enfermera.tratamientos', compact('tratamientos', 'validados'));
    }

    public function mostrarMedicinas()
    {
        $medicinas = Medicamento::all();
        return view('enfermera.medicinas', compact('medicinas'));
    }

    public function countTratamientos(){
        $tratamientos = Tratamiento::all()->count();

        return $tratamientos;
    }


    public function countMedicinas(){
        $medicinas = Medicamento::all()->count();

        return $medicinas;
    }


    public function validarReceta($id)
    {
        $tratamiento = Tratamiento::find($id);
        $archivo = Archivo::with('receta')->where('tratamiento_id', $id)->first();
        $medicinas = Medicamento::all();

        return view('enfermera.validarReceta', compact('tratamiento', 'archivo', 'medicinas'));
    }

    //SE RECIBE EL ID DEL TRATAMIENTO VA PARA QUE NO TE CONFUNDAS
    public function suministrarReceta($id)
    {
        $archivo = Archivo::with('expediente.paciente.user', 'receta', 'tratamiento.tratamiento_medicamentos.medicamento')->where('tratamiento_id', $id)->first();
        $tratamiento = Tratamiento::with('paciente.user')->find($id);

        return view('enfermera.suministrar', compact('archivo'));
    }

    public function suministrarMedicamento(Request $request, $id)
    {
        $time = new DateTime();
        $tratamiento = Tratamiento_medicamento::where('tratamiento_id', $id)->first();
        if ($tratamiento) {
            $lote = Lote::where('medicamento_id', $tratamiento->medicamento_id)
                ->where('cantidad', '>', 0)
                ->orderBy('fecha_vencimiento', 'asc')
                ->first();
            if (!$lote) {
                return redirect()->back()->with('failure', 'No hay lotes disponibles para este medicamento.');
            }
            $lote->cantidad -= 1;
            $lote->save();
            $tratamiento->dia_ultima = $time->format('Y-m-d');
            $tratamiento->hora_ultima = $time->format('H:i:s');
            $tratamiento->save();
            return redirect()->back()->with('success', 'Se suministro el medicamento del lote: ' . $lote->numero_lote);
        } else {
            return redirect()->back()->with('failure', 'No se encontro el tratamiento');
        }
    }

    public function registrarMedicina(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'via' => 'required|string|in:Oral,Sublingual,Rectal,Intravenosa,Intramuscular,Subcutánea,Tópica,Inhalatoria,Transdérmica,Vaginal,Intratecal,Intraauricular,Intraocular,Intraarterial,Epidural,Intranasal,Intraperitoneal',
                'concentracion' => 'required|string|max:255',
                'presentacion' => 'required|string|max:255',
            ]
        );

        Medicamento::create([
            'nombre' => $request->name,
            'descripcion' => $request->descripcion,
            'presentacion' => $request->presentacion,
            'concentracion' => $request->concentracion,
            'via_administracion' => $request->via,
        ]);

        return redirect()->route('medicinas')->with('success', 'Medicamento registrado correctamente');
    }

    public function verLote($id)
    {
        $medicina = Medicamento::find($id);
        $lotes = Lote::where('medicamento_id', $id)->get();


        return view('enfermera.verLotes', compact('medicina', 'lotes'));
    }


    public function registrarLote(Request $request, $id)
    {
        $request->validate(
            [
                "numero_lote" => "required|string|max:255|unique:lotes",
                "fecha" => "required|date",
                "cantidad" => "required|int|min:1",
            ]
        );

        Lote::create([
            "numero_lote" => $request->numeroLote,
            "fecha_vencimiento" => $request->fecha,
            "cantidad" => $request->cantidad,
            "medicamento_id" => $id
        ]);

        return redirect()->back()->with('success', 'El lote a sido registrado correctamente');
    }


    public function validarRecetaPost(Request $request, $id)
    {
        $validated = $request->validate([
            'medicamentos' => 'required|array|min:1',
            'medicamentos.*' => 'required|distinct|exists:medicamentos,id',

            'dosis' => 'required|array|size:' . count($request->medicamentos),
            'dosis.*' => 'required|integer|min:1',

            'horas' => 'required|array|size:' . count($request->medicamentos),
            'horas.*' => 'required|integer|min:1',

            'frecuencia' => 'required|array|size:' . count($request->medicamentos),
            'frecuencia.*' => 'required|string|max:255',

            'duracion_dias' => 'required|array|size:' . count($request->medicamentos),
            'duracion_dias.*' => 'required|integer|min:1',
        ], [
            'medicamentos.required' => 'Debes seleccionar al menos un medicamento.',
            'medicamentos.*.required' => 'Cada campo de medicamento debe estar lleno.',
            'medicamentos.*.distinct' => 'No puedes seleccionar medicamentos repetidos.',
            'medicamentos.*.exists' => 'Uno de los medicamentos no es válido.',

            'dosis.*.required' => 'La dosis es obligatoria.',
            'dosis.*.integer' => 'La dosis debe ser un número entero.',
            'dosis.*.min' => 'La dosis debe ser al menos 1.',

            'horas.*.required' => 'El campo días u horas es obligatorio.',
            'horas.*.integer' => 'Debe ser un número.',
            'horas.*.min' => 'Debe ser al menos 1.',

            'frecuencia.*.required' => 'La frecuencia es obligatoria.',
            'frecuencia.*.string' => 'La frecuencia debe ser texto.',
            'frecuencia.*.max' => 'La frecuencia no debe exceder 255 caracteres.',

            'duracion_dias.*.required' => 'La duración es obligatoria.',
            'duracion_dias.*.integer' => 'La duración debe ser un número.',
            'duracion_dias.*.min' => 'La duración debe ser al menos 1.',
        ]);

        for ($i = 0; $i < count($validated['medicamentos']); $i++) {
            Tratamiento_medicamento::create([
                'tratamiento_id' => $id,
                'medicamento_id' => $validated['medicamentos'][$i],
                'dosis' => $validated['dosis'][$i],
                'horas' => $validated['horas'][$i],
                'frecuencia' => $validated['frecuencia'][$i],
                'duracion_dias' => $validated['duracion_dias'][$i],
                'estado' => 'validado',
            ]);
        }

        return redirect()->route('tratamientos')->with('success', 'El tratamiento ha sido validado correctamente');
    }
}
