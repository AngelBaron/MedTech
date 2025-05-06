<?php

namespace App\Http\Controllers;

use App\Mail\RegistroPaciente;
use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Medico_dia;
use App\Models\Medico_especialidad;
use App\Models\Medico_horario;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class PacienteController extends Controller
{
    public function mostrarFormularioRegistro()
    {
        return view('auth.registrarPaciente');
    }

    public function mostrarAgendarCita()
    {
        $medicos = Medico::with(['Medico_dias', 'Medico_horarios', 'Medico_especialidads'])->get();
        $especialidades = Especialidad::all();

        return view('paciente.agendarCita', compact('medicos', 'especialidades'));
    }

    public function porDias($id)
    {
        $dias = Medico_dia::with('dia')->where('medico_id', $id)->get();
        return response()->json($dias);
    }

    public function porHoras($id)
    {
        $horarios = Medico_horario::where('medico_id', $id)->first();
        return response()->json($horarios);
    }

    public function porEspecialidad($id)
    {
        
        $medicos = Medico_especialidad::with('medico.user')->where('especialidad_id',$id)->get();
        return response()->json($medicos);
    }

    public function citasPorMedico($id, $fecha)
    {
        $citas = Cita::where('medico_id', $id)->where('fecha', $fecha)->get();
        return response()->json($citas);
    }


    public function agendarCita(Request $request)
    {
        
        
        $request->validate([
            'medicos' => 'required|exists:medicos,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|string|max:255',
        ]);
        
        

        $paciente = Paciente::where('user_id', Auth::user()->id)->first();

        

        Cita::create([
            'medico_id' => $request->medicos,
            'paciente_id' => $paciente->id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'motivo_cita' => $request->motivo
        ]);

        

        return redirect()->back()->with('success', 'Cita agendada con éxito.');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' => ['required', 'string', Password::defaults()],
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Paciente',
        ]);

        Paciente::create([
            'user_id' => $user->id,
        ]);

        Mail::to($request->email)->send(new RegistroPaciente(
            $request->nombre,
            $request->email,
            $request->password
        ));

        event(new Registered($user));


        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
