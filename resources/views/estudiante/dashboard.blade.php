@extends('layouts.estudiante')

@section('title', 'Dashboard - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Bienvenida -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">¡Hola, {{ $user->name }}! 👋</h1>
        <p class="text-gray-600 mt-2">Bienvenido a tu panel de control</p>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Equipos -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Mis Equipos</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_equipos'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Proyectos -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Mis Proyectos</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_proyectos'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Evaluados -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Evaluados</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['proyectos_evaluados'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Promedio -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Promedio</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['promedio_puntuacion'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Eventos Activos -->
            @if($eventosActivos->count() > 0)
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">🔥 Eventos Activos</h2>
                    <a href="{{ route('estudiante.eventos') }}" class="text-sm text-blue-600 hover:text-blue-700 font-semibold">
                        Ver todos →
                    </a>
                </div>
                <div class="space-y-4">
                    @foreach($eventosActivos as $evento)
                    <a href="{{ route('estudiante.evento-detalle', $evento->id) }}" 
                       class="block p-4 rounded-xl border border-gray-200 hover:border-blue-300 hover:shadow-sm transition-all">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-1">{{ $evento->title }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($evento->description, 80) }}</p>
                                <div class="flex items-center gap-3 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($evento->event_start_date)->format('d M Y') }}
                                    </span>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full font-semibold">
                                        Inscripciones abiertas
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Mis Proyectos -->
            @if($proyectos->count() > 0)
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">📁 Mis Proyectos</h2>
                    <a href="{{ route('estudiante.proyectos') }}" class="text-sm text-blue-600 hover:text-blue-700 font-semibold">
                        Ver todos →
                    </a>
                </div>
                <div class="space-y-4">
                    @foreach($proyectos->take(3) as $proyecto)
                    <a href="{{ route('estudiante.proyectos.show', $proyecto->id) }}" 
                       class="block p-4 rounded-xl border border-gray-200 hover:border-blue-300 hover:shadow-sm transition-all">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-1">{{ $proyecto->title }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $proyecto->team->name ?? 'Sin equipo' }}</p>
                                @if($proyecto->event)
                                <p class="text-xs text-gray-500">{{ $proyecto->event->title }}</p>
                                @endif
                            </div>
                            @if($proyecto->final_score)
                            <div class="ml-4">
                                <div class="text-2xl font-bold text-gray-900">{{ $proyecto->final_score }}</div>
                                <div class="text-xs text-gray-500">puntos</div>
                            </div>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @else
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Sin proyectos</h3>
                <p class="text-gray-600 mb-4">Crea tu primer proyecto para empezar</p>
                <a href="{{ route('estudiante.proyectos') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                    Crear proyecto
                </a>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Mis Equipos -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-lg text-gray-900">Mis Equipos</h3>
                    <a href="{{ route('estudiante.equipos') }}" class="text-sm text-blue-600 hover:text-blue-700 font-semibold">
                        Ver todos
                    </a>
                </div>
                @if($equipos->count() > 0)
                <div class="space-y-3">
                    @foreach($equipos->take(3) as $equipo)
                    <a href="{{ route('estudiante.equipos.show', $equipo->id) }}" 
                       class="block p-3 rounded-lg border border-gray-200 hover:border-blue-300 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($equipo->name, 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-900 text-sm truncate">{{ $equipo->name }}</p>
                                <p class="text-xs text-gray-600">{{ $equipo->members_count }} miembros</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <p class="text-sm text-gray-600 mb-3">No tienes equipos</p>
                    <a href="{{ route('estudiante.equipos') }}" 
                       class="text-sm text-blue-600 hover:text-blue-700 font-semibold">
                        Crear equipo →
                    </a>
                </div>
                @endif
            </div>

            <!-- Notificaciones -->
            @if($notificaciones->count() > 0)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-bold text-lg text-gray-900 mb-4">🔔 Notificaciones</h3>
                <div class="space-y-3">
                    @foreach($notificaciones->take(3) as $notif)
                    <div class="p-3 rounded-lg {{ $notif->is_read ? 'bg-gray-50' : 'bg-blue-50' }}">
                        <p class="font-semibold text-gray-900 text-sm">{{ $notif->title }}</p>
                        <p class="text-xs text-gray-600 mt-1">{{ $notif->message }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
