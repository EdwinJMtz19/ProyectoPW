@extends('layouts.asesor-dashboard')

@section('title', 'Eventos - Asesor')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Eventos</h1>
        <p class="text-gray-600 mt-1">Explora y participa en concursos académicos</p>
    </div>

    <!-- Tabs de filtros -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button onclick="filtrarEventos('todos')" id="tab-todos" class="px-4 py-3 font-semibold text-gray-900 border-b-2 border-gray-900 transition-colors">
            Todos ({{ $todosCount }})
        </button>
        <button onclick="filtrarEventos('in_progress')" id="tab-in_progress" class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900 transition-colors">
            Activos ({{ $activosCount }})
        </button>
        <button onclick="filtrarEventos('upcoming')" id="tab-upcoming" class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900 transition-colors">
            Próximos ({{ $proximosCount }})
        </button>
        <button onclick="filtrarEventos('finished')" id="tab-finished" class="px-4 py-3 font-medium text-gray-600 hover:text-gray-900 transition-colors">
            Finalizados ({{ $finalizadosCount }})
        </button>
    </div>

    <!-- Grid de Eventos -->
    <div id="eventos-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($eventos as $evento)
        <!-- Evento {{ $loop->iteration }} -->
        <div class="evento-card bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all overflow-hidden group {{ $evento->status === 'finished' ? 'opacity-90' : '' }}" data-status="{{ $evento->status }}">
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
                    @if($evento->status === 'in_progress')
                        <span class="px-3 py-1 bg-gray-900 text-white text-xs font-semibold rounded">En curso</span>
                    @elseif($evento->status === 'upcoming')
                        <span class="px-3 py-1 bg-gray-700 text-white text-xs font-semibold rounded">Próximamente</span>
                    @elseif($evento->status === 'finished')
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
        <div id="no-eventos" class="col-span-3 text-center py-16">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500 text-lg">No hay eventos disponibles</p>
        </div>
        @endforelse
    </div>
</div>

<script>
function filtrarEventos(filtro) {
    // Remover clases activas de todos los tabs
    document.querySelectorAll('[id^="tab-"]').forEach(tab => {
        tab.classList.remove('font-semibold', 'text-gray-900', 'border-b-2', 'border-gray-900');
        tab.classList.add('font-medium', 'text-gray-600');
    });
    
    // Agregar clases activas al tab seleccionado
    const tabActivo = document.getElementById('tab-' + filtro);
    if (tabActivo) {
        tabActivo.classList.add('font-semibold', 'text-gray-900', 'border-b-2', 'border-gray-900');
        tabActivo.classList.remove('font-medium', 'text-gray-600');
    }
    
    // Filtrar eventos
    const eventos = document.querySelectorAll('.evento-card');
    let eventosVisibles = 0;
    
    eventos.forEach(evento => {
        const status = evento.getAttribute('data-status');
        
        if (filtro === 'todos' || status === filtro) {
            evento.style.display = 'block';
            eventosVisibles++;
        } else {
            evento.style.display = 'none';
        }
    });
    
    // Mostrar mensaje si no hay eventos
    const noEventos = document.getElementById('no-eventos');
    if (noEventos) {
        noEventos.style.display = eventosVisibles === 0 ? 'block' : 'none';
    }
}
</script>
@endsection
