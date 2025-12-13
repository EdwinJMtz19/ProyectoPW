@extends('layouts.juez')

@section('title', 'Evaluaciones - EvenTec')
@section('breadcrumb', 'Evaluaciones')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Mis Evaluaciones</h1>
        <p class="text-gray-600 mt-2 text-lg">Revisa y gestiona todas las evaluaciones realizadas.</p>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-sm font-medium mb-1">Pendientes</p>
                    <p class="text-4xl font-bold">{{ $pendingCount }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium mb-1">Completadas</p>
                    <p class="text-4xl font-bold">{{ $completedCount }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-1">Promedio</p>
                    <p class="text-4xl font-bold">{{ number_format($averageScore, 1) }}%</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <a href="{{ route('juez.evaluaciones', ['filter' => 'pending']) }}" 
                   class="px-8 py-4 text-sm font-semibold {{ $filter === 'pending' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300' }}">
                    Pendientes
                </a>
                <a href="{{ route('juez.evaluaciones', ['filter' => 'completed']) }}" 
                   class="px-8 py-4 text-sm font-semibold {{ $filter === 'completed' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300' }}">
                    Completadas
                </a>
                <a href="{{ route('juez.evaluaciones', ['filter' => 'all']) }}" 
                   class="px-8 py-4 text-sm font-semibold {{ $filter === 'all' ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300' }}">
                    Todas
                </a>
            </nav>
        </div>
    </div>

    @if($evaluations->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-gray-100">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                @if($filter === 'pending')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                @else
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                @endif
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                @if($filter === 'pending')
                    ¡Excelente! No hay evaluaciones pendientes
                @else
                    No hay evaluaciones {{ $filter === 'completed' ? 'completadas' : '' }}
                @endif
            </h3>
            <p class="text-gray-600">
                @if($filter === 'pending')
                    Has completado todas tus evaluaciones asignadas.
                @else
                    No se encontraron evaluaciones en esta categoría.
                @endif
            </p>
        </div>
    @else
        <!-- Lista de Evaluaciones -->
        <div class="space-y-6">
            @foreach($evaluations as $item)
                @if($isPending === true || ($isPending === 'mixed' && $item->item_type === 'pending'))
                    @php
                        $project = $item;
                        $event = $project->event;
                        $team = $project->team;
                        $leader = $team->leader;
                    @endphp
                    
                    <!-- Evaluación Pendiente -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $project->title }}</h3>
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Pendiente</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-1">
                                        <span class="font-medium">Equipo:</span> {{ $team ? $team->name : 'Sin equipo asignado' }}
                                    </p>
                                    <p class="text-sm text-gray-600 mb-1">
                                        <span class="font-medium">Evento:</span> {{ $event->title }}
                                    </p>
                                    @if($project->advisor)
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Asesor:</span> {{ $project->advisor->name }}
                                    </p>
                                    @endif
                                    @if($project->description)
                                        <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ Str::limit($project->description, 120) }}</p>
                                    @endif
                                </div>
                                <a href="{{ route('juez.evaluar-proyecto', $project->id) }}" 
                                   class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg whitespace-nowrap">
                                    Evaluar ahora
                                </a>
                            </div>

                            <div class="flex items-center gap-6 text-sm text-gray-600 border-t border-gray-100 pt-4 mt-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Fecha límite: <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($event->event_end_date)->format('d M Y') }}</span></span>
                                </div>
                                @if($project->submitted_at)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Entregado: <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($project->submitted_at)->format('d M Y') }}</span></span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif($isPending === false || ($isPending === 'mixed' && $item->item_type === 'completed'))
                    @php
                        $evaluation = $item;
                        $project = $evaluation->project;
                        $event = $project->event;
                        $team = $project->team;
                        
                        // Obtener calificaciones por criterio
                        $criteriaScores = $evaluation->scores->mapWithKeys(function($score) {
                            return [$score->criterion->name => $score->score];
                        });
                    @endphp
                    
                    <!-- Evaluación Completada -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $project->title }}</h3>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Completada</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-1">
                                        <span class="font-medium">Equipo:</span> {{ $team->name }}
                                    </p>
                                    <p class="text-sm text-gray-600 mb-1">
                                        <span class="font-medium">Evento:</span> {{ $event->title }}
                                    </p>
                                    @if($project->advisor)
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Asesor:</span> {{ $project->advisor->name }}
                                    </p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600 mb-1">Calificación</p>
                                    <p class="text-3xl font-bold text-green-600">{{ number_format($evaluation->total_score, 1) }}/100</p>
                                </div>
                            </div>

                            @if($criteriaScores->isNotEmpty())
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                    @foreach($criteriaScores as $criterionName => $score)
                                        <div class="text-center p-3 bg-gray-50 rounded-xl">
                                            <p class="text-xs text-gray-600 mb-1">{{ $criterionName }}</p>
                                            <p class="text-lg font-bold text-gray-900">{{ number_format($score, 0) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($evaluation->comments)
                                <div class="bg-gray-50 rounded-xl p-4 mb-4">
                                    <p class="text-xs text-gray-600 font-medium mb-1">Comentarios:</p>
                                    <p class="text-sm text-gray-700">{{ Str::limit($evaluation->comments, 200) }}</p>
                                </div>
                            @endif

                            <div class="flex items-center justify-between text-sm text-gray-600 border-t border-gray-100 pt-4 mt-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Evaluada el: <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($evaluation->completed_at)->format('d M Y') }}</span></span>
                                </div>
                                <span class="text-xs text-gray-500">
                                    Tiempo: {{ \Carbon\Carbon::parse($evaluation->started_at)->diffInMinutes(\Carbon\Carbon::parse($evaluation->completed_at)) }} min
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Paginación -->
        @if($evaluations->hasPages())
        <div class="mt-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4">
                {{ $evaluations->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    @endif
</div>
@endsection
