<h1> Nuevo registro de medico </h1>
<p> Se ha registrado un nuevo medico en el sistema.</p>
<p> Nombre: {{ $nombre }}</p>
<p> Cedula: {{ $cedula }}</p>
<p> Especialidad: {{ $especialidad }}</p>
<p> Correo: {{ $email }}</p>
<p>Sus días de trabajo es: <strong>
    @foreach ($dias as $dia)
        {{ $dia }} @if (!$loop->last)
            ,
        @endif
    @endforeach

</strong></p>
<p>Su horario de trabajo es:
<strong>
    @php
        $turnos_inicio_array = explode(',', $horario_inicio);
        $turnos_fin_array = explode(',', $horario_fin);
    @endphp
    @foreach ($turnos_inicio_array as $key => $inicio)
        INICIO: {{ $inicio }} - FINAL {{ $turnos_fin_array[$key] }}
        @if (!$loop->last)
            ,
        @endif
    @endforeach
</strong>
</p>
