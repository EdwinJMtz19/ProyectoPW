@extends('layouts.asesor-dashboard')

@section('title', 'Eventos - Asesor')

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
                    <span class="text-sm font-medium text-gray-800">Eventos</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Eventos</h1>
        <p class="text-gray-600 mt-1">Explora y participa en concursos académicos</p>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Buscador -->
            <div class="flex-1">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="buscarEventos" placeholder="Buscar eventos..." 
                           class="w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
            </div>

            <!-- Filtros -->
            <div class="flex gap-3">
                <select class="px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black bg-white">
                    <option>Todos</option>
                    <option>Activos</option>
                    <option>Próximos</option>
                    <option>Finalizados</option>
                </select>

                <select class="px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black bg-white">
                    <option>Todas</option>
                    <option>Tecnología</option>
                    <option>Ciencias</option>
                    <option>Robótica</option>
                </select>

                <!-- Vista Grid/Lista -->
                <div class="flex gap-2 border border-gray-300 rounded-lg p-1">
                    <button class="p-2 rounded bg-black text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 3H3v7h7V3zM21 3h-7v7h7V3zM21 14h-7v7h7v-7zM10 14H3v7h7v-7z"/>
                        </svg>
                    </button>
                    <button class="p-2 rounded hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs de filtros -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button class="px-4 py-3 font-semibold text-gray-900 border-b-2 border-gray-900">
            Todos ({{ $todosCount }})
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            Activos ({{ $activosCount }})
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            Próximos ({{ $proximosCount }})
        </button>
        <button class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900">
            Finalizados ({{ $finalizadosCount }})
        </button>
    </div>

    <!-- Grid de Eventos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($eventos as $evento)
        <!-- Evento {{ $loop->iteration }} -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all overflow-hidden group {{ $evento->status === 'completed' ? 'opacity-90' : '' }}">
            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                @if($evento->cover_image_url)
                    <img src="{{ $evento->cover_image_url }}" 
                         alt="{{ $evento->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
                <div class="absolute top-4 left-4">
                    @if($evento->status === 'ongoing')
                        <span class="px-3 py-1 bg-gray-900 text-white text-xs font-semibold rounded">En curso</span>
                    @elseif($evento->status === 'upcoming')
                        <span class="px-3 py-1 bg-gray-700 text-white text-xs font-semibold rounded">Próximamente</span>
                    @elseif($evento->status === 'completed')
                        <span class="px-3 py-1 bg-gray-500 text-white text-xs font-semibold rounded">Finalizado</span>
                    @else
                        <span class="px-3 py-1 bg-gray-400 text-white text-xs font-semibold rounded">{{ ucfirst($evento->status) }}</span>
                    @endif
                </div>
                <div class="absolute top-4 right-4">
                    <span class="px-3 py-1 bg-white text-gray-900 text-xs font-semibold rounded">{{ ucfirst($evento->category) }}</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $evento->title }}</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    {{ $evento->short_description ?? Str::limit($evento->description, 100) }}
                </p>
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ \Carbon\Carbon::parse($evento->event_start_date)->format('d M') }}
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        {{ $evento->registered_teams_count }} equipos
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        {{ $evento->min_team_size }}-{{ $evento->max_team_size }} integrantes
                    </div>
                </div>
                <a href="{{ route('asesor.evento-detalle', $evento->id) }}" 
                   class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm">
                    Ver detalles
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500 text-lg">No hay eventos disponibles</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
