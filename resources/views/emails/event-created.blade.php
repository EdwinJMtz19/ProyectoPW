@extends('emails.layout')

@section('title', 'Nuevo Evento Creado')

@section('content')
    <h2>¡Nuevo Evento Disponible!</h2>

    <p>Se ha creado un nuevo evento en EventTecNM que podría interesarte.</p>

    <div class="info-box">
        <strong>{{ $event->title }}</strong><br><br>
        <strong>Categoría:</strong> {{ $event->category }}<br>
        <strong>Fecha del evento:</strong> {{ \Carbon\Carbon::parse($event->event_start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($event->event_end_date)->format('d/m/Y') }}<br>
        <strong>Registro hasta:</strong> {{ \Carbon\Carbon::parse($event->registration_end_date)->format('d/m/Y') }}<br>
        @if($event->is_online)
            <strong>Modalidad:</strong> En línea
        @else
            <strong>Ubicación:</strong> {{ $event->location ?? 'Por definir' }}
        @endif
    </div>

    <p><strong>Descripción:</strong></p>
    <p>{{ $event->description }}</p>

    <div class="divider"></div>

    <p><strong>Requisitos del equipo:</strong></p>
    <ul style="margin-left: 20px; margin-bottom: 20px;">
        <li>Tamaño mínimo: {{ $event->min_team_size }} integrantes</li>
        <li>Tamaño máximo: {{ $event->max_team_size }} integrantes</li>
        @if($event->max_teams)
            <li>Cupo máximo: {{ $event->max_teams }} equipos</li>
        @endif
    </ul>

    <center>
        <a href="{{ config('app.url') }}/eventos/{{ $event->id }}" class="button">Ver Detalles del Evento</a>
    </center>

    <p style="font-size: 13px; color: #888; margin-top: 20px;">
        ¡No pierdas esta oportunidad! Registra tu equipo antes de que se agoten los lugares.
    </p>
@endsection
