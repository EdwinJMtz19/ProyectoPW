@extends('layouts.juez')

@section('title', 'Rankings - EvenTec')
@section('breadcrumb', 'Rankings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Rankings de Proyectos</h1>
        <p class="text-gray-600 mt-2 text-lg">Visualiza los mejores proyectos basados en las evaluaciones.</p>
    </div>

    <!-- Filtro de Evento -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <form method="GET" action="{{ route('juez.rankings') }}">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Seleccionar Evento</label>
                    <select name="event_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" onchange="this.form.submit()">
                        <option value="">Todos los eventos</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ $eventId == $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                    <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" onchange="this.form.submit()">
                        <option value="">Todas</option>
                        <option value="technology" {{ $category == 'technology' ? 'selected' : '' }}>Tecnología</option>
                        <option value="science" {{ $category == 'science' ? 'selected' : '' }}>Ciencias</option>
                        <option value="business" {{ $category == 'business' ? 'selected' : '' }}>Negocios</option>
                        <option value="engineering" {{ $category == 'engineering' ? 'selected' : '' }}>Ingeniería</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    @if($selectedEvent)
        <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-4 mb-6">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-medium text-indigo-900">
                        Mostrando resultados de: <span class="font-bold">{{ $selectedEvent->title }}</span>
                    </p>
                    <p class="text-xs text-indigo-700">{{ $projects->count() }} proyecto{{ $projects->count() != 1 ? 's' : '' }} evaluado{{ $projects->count() != 1 ? 's' : '' }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($projects->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-gray-100">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay rankings disponibles</h3>
            <p class="text-gray-600">No se encontraron proyectos evaluados para mostrar.</p>
        </div>
    @else
        <!-- Top 3 Podio -->
        @if($projects->count() >= 3)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @php
                $topThree = $projects->take(3);
                $second = $topThree->get(1);
                $first = $topThree->get(0);
                $third = $topThree->get(2);
            @endphp

            <!-- Segundo Lugar -->
            @if($second)
            <div class="order-2 md:order-1">
                <div class="bg-gradient-to-br from-gray-400 to-gray-500 rounded-t-2xl p-6 text-white text-center">
                    <div class="w-20 h-20 mx-auto mb-3 bg-white rounded-full flex items-center justify-center">
                        <span class="text-4xl">🥈</span>
                    </div>
                    <p class="text-sm font-medium mb-1">2do Lugar</p>
                    <p class="text-3xl font-bold">{{ number_format($second->final_score, 1) }}</p>
                </div>
                <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $second->title }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $second->team->name }}</p>
                    @if($second->criteria_averages->isNotEmpty())
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            @foreach($second->criteria_averages->take(4) as $criterionName => $score)
                                <div class="bg-gray-50 p-2 rounded-lg text-center">
                                    <p class="text-gray-600 truncate">{{ $criterionName }}</p>
                                    <p class="font-bold text-gray-900">{{ number_format($score, 0) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Primer Lugar -->
            @if($first)
            <div class="order-1 md:order-2">
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-t-2xl p-6 text-white text-center">
                    <div class="w-24 h-24 mx-auto mb-3 bg-white rounded-full flex items-center justify-center">
                        <span class="text-5xl">🥇</span>
                    </div>
                    <p class="text-sm font-medium mb-1">1er Lugar</p>
                    <p class="text-4xl font-bold">{{ number_format($first->final_score, 1) }}</p>
                </div>
                <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $first->title }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $first->team->name }}</p>
                    @if($first->criteria_averages->isNotEmpty())
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            @foreach($first->criteria_averages->take(4) as $criterionName => $score)
                                <div class="bg-gray-50 p-2 rounded-lg text-center">
                                    <p class="text-gray-600 truncate">{{ $criterionName }}</p>
                                    <p class="font-bold text-gray-900">{{ number_format($score, 0) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Tercer Lugar -->
            @if($third)
            <div class="order-3">
                <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-t-2xl p-6 text-white text-center">
                    <div class="w-20 h-20 mx-auto mb-3 bg-white rounded-full flex items-center justify-center">
                        <span class="text-4xl">🥉</span>
                    </div>
                    <p class="text-sm font-medium mb-1">3er Lugar</p>
                    <p class="text-3xl font-bold">{{ number_format($third->final_score, 1) }}</p>
                </div>
                <div class="bg-white rounded-b-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $third->title }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $third->team->name }}</p>
                    @if($third->criteria_averages->isNotEmpty())
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            @foreach($third->criteria_averages->take(4) as $criterionName => $score)
                                <div class="bg-gray-50 p-2 rounded-lg text-center">
                                    <p class="text-gray-600 truncate">{{ $criterionName }}</p>
                                    <p class="font-bold text-gray-900">{{ number_format($score, 0) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
        @endif

        <!-- Tabla Completa -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900">Clasificación Completa</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Posición</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Proyecto</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Equipo</th>
                            @if($projects->first() && $projects->first()->criteria_averages->isNotEmpty())
                                @foreach($projects->first()->criteria_averages as $criterionName => $score)
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ $criterionName }}</th>
                                @endforeach
                            @endif
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($projects as $project)
                            @php
                                $rankClass = '';
                                if ($project->display_rank == 1) {
                                    $rankClass = 'bg-yellow-50';
                                } elseif ($project->display_rank == 2) {
                                    $rankClass = 'bg-gray-50';
                                } elseif ($project->display_rank == 3) {
                                    $rankClass = 'bg-orange-50';
                                }
                            @endphp
                            <tr class="{{ $rankClass }} hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($project->display_rank == 1)
                                            <span class="text-2xl mr-2">🥇</span>
                                        @elseif($project->display_rank == 2)
                                            <span class="text-2xl mr-2">🥈</span>
                                        @elseif($project->display_rank == 3)
                                            <span class="text-2xl mr-2">🥉</span>
                                        @endif
                                        <span class="text-lg font-bold text-gray-900">{{ $project->display_rank }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-semibold text-gray-900">{{ $project->title }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-700">{{ $project->team->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $project->team->leader->name }}</p>
                                </td>
                                @if($project->criteria_averages->isNotEmpty())
                                    @foreach($project->criteria_averages as $score)
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                                {{ $score >= 90 ? 'bg-green-100 text-green-700' : 
                                                   ($score >= 80 ? 'bg-blue-100 text-blue-700' : 
                                                   ($score >= 70 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700')) }}">
                                                {{ number_format($score, 0) }}
                                            </span>
                                        </td>
                                    @endforeach
                                @endif
                                <td class="px-6 py-4 text-center">
                                    <span class="px-4 py-2 rounded-full text-sm font-bold
                                        {{ $project->final_score >= 90 ? 'bg-green-100 text-green-700' : 
                                           ($project->final_score >= 80 ? 'bg-blue-100 text-blue-700' : 
                                           ($project->final_score >= 70 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700')) }}">
                                        {{ number_format($project->final_score, 1) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
