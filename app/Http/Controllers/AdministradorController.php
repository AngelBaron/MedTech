<?php

namespace App\Http\Controllers;

use App\Mail\NotificacionEnfermera;
use App\Mail\NotificacionEnfermera_Admin;
use App\Mail\NotificacionMedico;
use App\Mail\NotificacionMedico_Admin;
use App\Models\Dia;
use App\Models\Enfermera;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Medico_dia;
use App\Models\Medico_especialidad;
use App\Models\Medico_horario;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdministradorController extends Controller
{
    public function registrarMedico()
    {
        $especialidades = Especialidad::all();
        return view('administrador.registrarMedico', compact('especialidades'));
    }

    public function registrarEnfermera()
    {
        return view('administrador.registrarEnfermera');
    }

    public function mostrarregistrarEspecialidad(){
        $especialidades = Especialidad::all();

        return view('administrador.registrarEspecialidad', compact('especialidades'));
    }

    public function crearEspecialidad(Request $request){
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidads',
        ]);

        // Crear la especialidad en la base de datos
        Especialidad::create([
            'nombre' => $request->nombre,
        ]);

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->route('registrarEspecialidad')->with('success', 'Especialidad registrada exitosamente.');
    }

    public function destroyEspecialidad($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();
        return redirect()->route('registrarEspecialidad')->with('success', 'Especialidad eliminada correctamente');
    }

    public function actualizarEspecialidad(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $especialidad = Especialidad::find($request->id);
        $especialidad->nombre = $request->name;
        $especialidad->save();

        return redirect()->route('registrarEspecialidad')->with('success', 'Especialidad actualizada correctamente');
    }


    public function crearEnfermera(Request $request)
    {
        $pass = $this->generarContrasenaAleatoria();

        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pass,
            'role' => 'Enfermera',
        ]);

        Enfermera::create([
            'user_id' => $user->id,
        ]);

        Mail::to($user->email)->send(new NotificacionEnfermera(
            $user->name,
            $pass
        ));


        $admins = User::where('role', 'Administrador')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NotificacionEnfermera_Admin(
                $user->name,
                $user->email
            ));
        }

        event(new Registered($user));

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->route('registrarEnfermera')->with('success', 'Enfermera registrada exitosamente.');
    }

    public function crearMedico(Request $request)
    {
        $pass = $this->generarContrasenaAleatoria();



        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'especialidad' => 'required|string|max:255|exists:especialidads,id',
            'cedula' => 'required|string|max:255|unique:medicos',
            'dias' => 'required|array|min:1|max:7',
            'dias.*' => 'in:Lunes,Martes,Miercoles,Jueves,Viernes,Sabado,Domingo',
            'turno' => 'required|string|in:1,2,3',
        ]);

        $horarios = [
            '1' => ['08:00:00', '16:00:00'],
            '2' => ['16:00:00', '00:00:00'],
            '3' => ['00:00:00', '08:00:00'],
        ];

        [$horario_inicio, $horario_fin] = $horarios[$request->turno];

        // Crear el user en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pass,
            'role' => 'Medico',

        ]);

        // Crear el médico asociado al usuario
        $medico = Medico::create([
            'cedula' => $request->cedula,
            'user_id' => $user->id,
        ]);

        Medico_especialidad::create([
            'medico_id' => $medico->id,
            'especialidad_id' => $request->especialidad,
        ]);

        



        // Crear el horario asociado al medico

        Medico_horario::create([
            'medico_id' => $medico->id,
            'horario_inicio' => $horario_inicio,
            'horario_fin' => $horario_fin,


        ]);

        foreach ($request->dias as $dia) {
            // Crear el dia asociado al medico
            Medico_dia::create([
                'medico_id' => $medico->id,
                'dia_id' => Dia::where('nombre', $dia)->first()->id,
            ]);
        }




        // Enviar un correo electrónico al médico con su contraseña

        Mail::to($user->email)->send(new NotificacionMedico(
            $user->name,
            $pass,
            $request->dias,
            Medico_horario::where('medico_id', $medico->id)->first()->horario_inicio,
            Medico_horario::where('medico_id', $medico->id)->first()->horario_fin,

        ));

        $admins = User::where('role', 'Administrador')->get();


        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NotificacionMedico_Admin(
                $user->name,
                $request->cedula,
                $request->especialidad,
                $user->email,
                $request->dias,
                Medico_horario::where('medico_id', $medico->id)->first()->horario_inicio,
                Medico_horario::where('medico_id', $medico->id)->first()->horario_fin,
            ));
        }


        event(new Registered($user));



        // Redirigir o mostrar un mensaje de éxito
        return redirect()->route('registrarMedico')->with('success', 'Médico registrado exitosamente.');
    }

    public function registrarAdministrador()
    {
        return view('administrador.registrarMedico');
    }

    //funcion para hacer una contraseña aleatoria
    protected function generarContrasenaAleatoria($longitud = 12)
    {
        return substr(str_shuffle(
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-='
        ), 0, $longitud);
    }
}
