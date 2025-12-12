@extends('emails.layout')

@section('title', 'Asignación como Juez')

@section('content')
    <h2>Asignación como Juez</h2>

    <p>Hola <strong>{{ $judge->name }}</strong>,</p>

    <p>Has sido asignado como juez para el siguiente evento:</p>

    <div class="info-box">
        <strong>{{ $event->title }}</strong><br><br>
        <strong>Categoría:</strong> {{ $event->category }}<br>
        <strong>Fecha del evento:</strong> {{ \Carbon\Carbon::parse($event->event_start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($event->event_end_date)->format('d/m/Y') }}<br>
        @if($event->is_online)
            <strong>Modalidad:</strong> En línea
        @else
            <strong>Ubicación:</strong> {{ $event->location ?? 'Por definir' }}
        @endif
    </div>

    <p><strong>Tus responsabilidades como juez:</strong></p>
    <ul style="margin-left: 20px; margin-bottom: 20px;">
        <li>Evaluar los proyectos presentados</li>
        <li>Proporcionar retroalimentación constructiva</li>
        <li>Asignar calificaciones según los criterios establecidos</li>
        <li>Mantener imparcialidad en las evaluaciones</li>
    </ul>

    <center>
        <a href="{{ config('app.url') }}/juez/eventos/{{ $event->id }}" class="button">Ver Evento</a>
    </center>

    <div class="divider"></div>

    <p style="font-size: 13px; color: #888;">
        Por favor, confirma tu disponibilidad lo antes posible. Si tienes alguna pregunta, contacta al organizador del evento.
    </p>
@endsection
