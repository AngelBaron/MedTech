<?php

namespace App\Http\Controllers;

use App\Mail\RegistroPaciente;
use App\Models\Medico;
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
        $medicos = Medico::with(['Medico_dias','Medico_horarios'])->get();

        return view('paciente.agendarCita', compact('medicos'));
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
            'user_id' => $user -> id,
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
