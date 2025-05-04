<p>Hola {{ $nombre }}, tu cuenta ha sido creada.</p>
<p>Tu contraseña temporal es: <strong>{{ $password }}</strong></p>
<p>Te recomendamos cambiarla después de iniciar sesión.</p>
<p>Tus días de trabajo es: <strong>
        @foreach ($dias as $dia)
            {{ $dia }} @if (!$loop->last)
                ,
            @endif
        @endforeach

    </strong></p>
<p>Tu horario de trabajo es:
    <strong>
        INICIO: {{ $horario_inicio }} - FINAL {{ $horario_fin }}
    </strong>
</p>
<p>Por favor, verifica tu información y asegúrate de que sea correcta.</p>
<p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>
<p>Si no has solicitado este registro, por favor ignora este mensaje.</p>
<p>Saludos, Medtech</p>
