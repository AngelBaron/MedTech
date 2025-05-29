<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Medtech</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif

                    @if (Route::has('registrarPaciente'))
                        <a href="{{ route('registrarPaciente') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            RegistrarPaciente
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    {{-- Página de bienvenida --}}
    <section class="bg-white dark:bg-[#121212] py-16 w-full">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white mb-4">
                Bienvenido a MedTech
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                MedTech es una herramienta digital integral para la gestión de citas médicas, recetas, tratamientos y
                control de medicamentos.
            </p>
        </div>
    </section>

    <section class="bg-gray-100 dark:bg-[#1e1e1e] py-12 w-full">
        <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-[#2a2a2a] rounded-xl p-6 shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-2">Pacientes</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Regístrate fácilmente, solicita citas y consulta tu historial clínico desde cualquier dispositivo.
                </p>
            </div>
            <div class="bg-white dark:bg-[#2a2a2a] rounded-xl p-6 shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-green-600 dark:text-green-400 mb-2">Médicos</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Administra tu calendario, confirma o rechaza citas, y registra diagnósticos, recetas y tratamientos.
                </p>
            </div>
            <div class="bg-white dark:bg-[#2a2a2a] rounded-xl p-6 shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-purple-600 dark:text-purple-400 mb-2">Enfermería</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Lleva el control de medicamentos, registra lotes y valida suministros durante el tratamiento del
                    paciente.
                </p>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white dark:bg-[#121212] w-full">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Gestión médica moderna y eficiente</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                MedTech mejora la comunicación entre pacientes, médicos y personal de salud, digitalizando procesos
                clínicos clave.
            </p>
            <a href="{{ route('register') }}"
                class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg">
                Comenzar ahora
            </a>
        </div>
    </section>




    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
