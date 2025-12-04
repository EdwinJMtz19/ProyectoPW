@extends('layouts.asesor-dashboard')

@section('title', 'Equipos - Asesor')

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
                    <span class="text-sm font-medium text-gray-800">Equipos</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Equipos</h1>
        <p class="text-gray-600 mt-1">Gestiona tus equipos y colabora con otros participantes</p>
    </div>

    <!-- Barra de búsqueda y filtros -->
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 mb-6">
        <div class="flex flex-col md:flex-row gap-4 items-center">
            <!-- Buscador -->
            <div class="flex-1 w-full">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="buscarEquipos" placeholder="Buscar equipos..." 
                           class="w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                </div>
            </div>

            <!-- Filtro por evento -->
            <select class="px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black bg-white">
                <option>Todos los eventos</option>
                @foreach($eventos as $evento)
                    <option value="{{ $evento->id }}">{{ $evento->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Lista de Equipos o Estado vacío -->
    @if($equipos->count() > 0)
        <!-- Grid de Equipos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($equipos as $equipo)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all overflow-hidden">
                <!-- Header del card -->
                <div class="bg-gradient-to-r from-gray-900 to-gray-700 p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-white mb-1">{{ $equipo->name }}</h3>
                            <p class="text-gray-300 text-sm">{{ $equipo->event->title ?? 'Sin evento' }}</p>
                        </div>
                        <span class="px-3 py-1 bg-white bg-opacity-20 text-white text-xs font-semibold rounded-full">
                            {{ ucfirst($equipo->status) }}
                        </span>
                    </div>
                </div>

                <!-- Contenido del card -->
                <div class="p-6">
                    <!-- Descripción -->
                    @if($equipo->description)
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ $equipo->description }}
                        </p>
                    @else
                        <p class="text-gray-400 text-sm mb-4 italic">
                            Sin descripción
                        </p>
                    @endif

                    <!-- Estadísticas -->
                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span>{{ $equipo->members_count }} miembros</span>
                        </div>
                        @if($equipo->project)
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span>Proyecto</span>
                            </div>
                        @endif
                    </div>

                    <!-- Miembros avatars -->
                    <div class="flex items-center mb-4">
                        <div class="flex -space-x-2">
                            @foreach($equipo->members->take(3) as $member)
                                <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs font-semibold text-gray-600">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                            @endforeach
                            @if($equipo->members_count > 3)
                                <div class="w-8 h-8 rounded-full bg-gray-100 border-2 border-white flex items-center justify-center text-xs font-semibold text-gray-500">
                                    +{{ $equipo->members_count - 3 }}
                                </div>
                            @endif
                        </div>
                        <span class="ml-3 text-xs text-gray-500">Integrantes</span>
                    </div>

                    <!-- Botón ver detalle -->
                    <a href="#" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm">
                        Ver Equipo
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">No tienes equipos</h2>
            <p class="text-gray-600 mb-6 max-w-md mx-auto">
                Aún no eres parte de ningún equipo
            </p>
        </div>
    @endif
</div>

@endsection
