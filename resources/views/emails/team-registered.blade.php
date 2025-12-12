@extends('emails.layout')

@section('title', 'Equipo Registrado Exitosamente')

@section('content')
    <h2>¡Registro Exitoso!</h2>

    <p>Tu equipo <strong>{{ $team->name }}</strong> ha sido registrado exitosamente en el evento:</p>

    <div class="info-box">
        <strong>{{ $event->title }}</strong><br><br>
        <strong>Nombre del equipo:</strong> {{ $team->name }}<br>
        <strong>Fecha del evento:</strong> {{ \Carbon\Carbon::parse($event->event_start_date)->format('d/m/Y') }}<br>
        <strong>Estado:</strong> Registrado
    </div>

    <p><strong>Próximos pasos:</strong></p>
    <ol style="margin-left: 20px; margin-bottom: 20px;">
        <li>Completa la información de tu equipo</li>
        <li>Sube la documentación de tu proyecto</li>
        <li>Busca un asesor para tu equipo (si aplica)</li>
        <li>Prepárate para la presentación</li>
    </ol>

    <center>
        <a href="{{ config('app.url') }}/equipos/{{ $team->id }}" class="button">Ver Mi Equipo</a>
    </center>

    <div class="divider"></div>

    <p style="font-size: 13px; color: #888;">
        Mantente atento a tu correo para recibir actualizaciones sobre el evento.
    </p>
@endsection
