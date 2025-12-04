@extends('layouts.asesor-dashboard')

@section('title', 'Proyectos - Asesor')

@section('content')
<div class="p-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1">
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-800">Proyectos</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Proyectos</h1>
        <p class="text-gray-600 mt-1">Gestiona y supervisa los proyectos de tus equipos</p>
    </div>

    <!-- Tabs -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button class="px-4 py-3 font-semibold text-gray-900 border-b-2 border-gray-900">
            Todos ({{ $todosCount }})
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            En progreso ({{ $enProgresoCount }})
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            Entregados ({{ $entregadosCount }})
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            Evaluados ({{ $evaluadosCount }})
        </button>
    </div>

    <!-- Lista de Proyectos -->
    @if($proyectos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($proyectos as $proyecto)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all overflow-hidden {{ $proyecto->status === 'evaluated' ? 'opacity-90' : '' }}">
                <!-- Header con color según estado -->
                <div class="p-6 pb-4">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-gray-900 line-clamp-2 flex-1">{{ $proyecto->title }}</h3>
                        @if($proyecto->status === 'draft' || $proyecto->status === 'in_progress')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full ml-2">En progreso</span>
                        @elseif($proyecto->status === 'submitted')
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full ml-2">Entregado</span>
                        @elseif($proyecto->status === 'evaluated')
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full ml-2">Evaluado</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full ml-2">{{ ucfirst($proyecto->status) }}</span>
                        @endif
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $proyecto->description ?? 'Sin descripción' }}
                    </p>
                    
                    <!-- Información del equipo y evento -->
                    <div class="space-y-2 text-sm text-gray-500 mb-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span>{{ $proyecto->team->name ?? 'Sin equipo' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $proyecto->team->event->title ?? 'Sin evento' }}</span>
                        </div>
                    </div>

                    <!-- Puntuación si está evaluado -->
                    @if($proyecto->final_score)
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="font-bold text-gray-900">{{ number_format($proyecto->final_score, 1) }}/100</span>
                        </div>
                    @endif

                    <!-- Botón ver detalles -->
                    <a href="#" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm">
                        Ver detalles
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- Estado vacío -->
        <div class="bg-white rounded-xl p-16 text-center shadow-sm border border-gray-200">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">No hay proyectos</h2>
            <p class="text-gray-600 mb-6 max-w-md mx-auto">
                Aún no hay proyectos registrados en tus equipos
            </p>
        </div>
    @endif
</div>
@endsection
