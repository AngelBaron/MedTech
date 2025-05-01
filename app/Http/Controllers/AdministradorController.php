<?php

namespace App\Http\Controllers;

use App\Mail\NotificacionMedico;
use App\Mail\NotificacionMedico_Admin;
use App\Models\Medico;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdministradorController extends Controller
{
    public function registrarMedico()
    {
        return view('administrador.registrarMedico');
    }

    public function crearMedico(Request $request)
    {
        $pass = $this->generarContrasenaAleatoria();

        

        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'especialidad' => 'required|string|max:255',
            'cedula' => 'required|string|max:255|unique:medicos',
        ]);



        

        

        // Crear el user en la base de datos

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pass,
            'rol' => 'Medico',

        ]);

        // Crear el médico asociado al usuario
        Medico::create([
            'cedula' => $request->cedula,
            'especialidad' => $request->especialidad,
            'user_id' => $user->id,
        ]);

        // Enviar un correo electrónico al médico con su contraseña

        Mail::to($user->email)->send(new NotificacionMedico(
            $user->name,
            $pass
        ));

        $admins = User::where('role', 'Administrador')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NotificacionMedico_Admin(
                $user->name,
                $request->cedula,
                $request->especialidad,
                $user->email
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
