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
    
    
        INICIO: {{ $horario_inicio }} - FINAL {{ $horario_fin }}
        
</strong>
</p>
