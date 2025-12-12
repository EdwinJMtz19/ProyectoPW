@extends('emails.layout')

@section('title', 'Asesor Asignado')

@section('content')
    <h2>¡Asesor Asignado a tu Equipo!</h2>

    <p>¡Excelentes noticias! <strong>{{ $advisor->name }}</strong> ha aceptado ser el asesor de tu equipo <strong>{{ $team->name }}</strong>.</p>

    <div class="info-box">
        <strong>Información del Asesor:</strong><br><br>
        <strong>Nombre:</strong> {{ $advisor->name }}<br>
        <strong>Email:</strong> {{ $advisor->email }}
    </div>

    <p><strong>Ahora puedes:</strong></p>
    <ul style="margin-left: 20px; margin-bottom: 20px;">
        <li>Comunicarte directamente con tu asesor</li>
        <li>Recibir retroalimentación sobre tu proyecto</li>
        <li>Solicitar reuniones de seguimiento</li>
        <li>Obtener orientación académica</li>
    </ul>

    <center>
        <a href="{{ config('app.url') }}/equipos/{{ $team->id }}" class="button">Ver Mi Equipo</a>
    </center>

    <div class="divider"></div>

    <p style="font-size: 13px; color: #888;">
        Te recomendamos establecer contacto con tu asesor lo antes posible para comenzar a trabajar en tu proyecto.
    </p>
@endsection
