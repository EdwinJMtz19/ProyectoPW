@extends('emails.layout')

@section('title', 'Solicitud de Asesoría')

@section('content')
    <h2>Nueva Solicitud de Asesoría</h2>

    <p>Hola <strong>{{ $advisor->name }}</strong>,</p>

    <p>El equipo <strong>{{ $team->name }}</strong> te ha enviado una solicitud para que seas su asesor.</p>

    <div class="info-box">
        <strong>Detalles del equipo:</strong><br><br>
        <strong>Nombre:</strong> {{ $team->name }}<br>
        <strong>Evento:</strong> {{ $team->event->title ?? 'N/A' }}<br>
        <strong>Proyecto:</strong> {{ $team->project->title ?? 'En desarrollo' }}
    </div>

    @if($message)
    <p><strong>Mensaje del equipo:</strong></p>
    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0;">
        <em>"{{ $message }}"</em>
    </div>
    @endif

    <p>Puedes aceptar o rechazar esta solicitud desde tu panel de asesor.</p>

    <center>
        <a href="{{ config('app.url') }}/asesor/equipos" class="button">Ver Solicitud</a>
    </center>

    <div class="divider"></div>

    <p style="font-size: 13px; color: #888;">
        Si aceptas, podrás guiar al equipo durante todo el proceso del proyecto.
    </p>
@endsection
