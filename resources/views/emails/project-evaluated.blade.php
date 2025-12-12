@extends('emails.layout')

@section('title', 'Proyecto Evaluado')

@section('content')
    <h2>¡Tu Proyecto ha sido Evaluado!</h2>

    <p>Nos complace informarte que tu proyecto <strong>{{ $project->title }}</strong> ha sido evaluado.</p>

    <div class="info-box">
        <strong>Resultados de la Evaluación:</strong><br><br>
        <strong>Proyecto:</strong> {{ $project->title }}<br>
        <strong>Puntuación Final:</strong> {{ number_format($project->final_score, 2) }} / 100<br>
        @if($project->rank)
            <strong>Posición:</strong> #{{ $project->rank }}
        @endif
    </div>

    @if($project->feedback)
    <p><strong>Retroalimentación de los Jueces:</strong></p>
    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0;">
        {{ $project->feedback }}
    </div>
    @endif

    <p>Puedes ver los detalles completos de tu evaluación en tu panel de estudiante.</p>

    <center>
        <a href="{{ config('app.url') }}/proyectos/{{ $project->id }}" class="button">Ver Detalles Completos</a>
    </center>

    <div class="divider"></div>

    <p style="font-size: 13px; color: #888;">
        ¡Gracias por tu participación! Esperamos verte en futuros eventos.
    </p>
@endsection
