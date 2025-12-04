@extends('layouts.asesor-dashboard')

@section('title', 'Dashboard - Asesor')

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
                    <span class="text-sm font-medium text-gray-800">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">¡Hola, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
        <p class="text-gray-600 mt-1">Gestiona tus equipos y ayúdales a alcanzar el éxito.</p>
    </div>

    <!-- Estadísticas Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Equipos Asesorados -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Equipos Asesorados</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $equipos->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Proyectos Activos -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Proyectos Activos</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $proyectos }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Eventos Activos -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Eventos Activos</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $eventos }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Notificaciones -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Notificaciones</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $notificaciones }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid: Mis Equipos + Gráfica -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Mis Equipos - 2/3 del ancho -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 h-full">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Mis Equipos</h2>
                <a href="{{ route('asesor.equipos') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                    Ver todos →
                </a>
            </div>
            <div class="p-6">
                @if($equipos->count() > 0)
                    <div class="space-y-4">
                        @foreach($equipos->take(3) as $equipo)
                            <a href="{{ route('asesor.equipos') }}" 
                               class="block p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-sm transition-all">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($equipo->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900">{{ $equipo->name }}</h3>
                                            <p class="text-sm text-gray-600">{{ $equipo->event->title ?? 'Sin evento' }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-600">{{ $equipo->members_count }} miembros</div>
                                        <button class="mt-2 px-4 py-1.5 bg-gray-900 text-white text-sm rounded-lg hover:bg-gray-800 transition-colors font-medium">
                                            Ver equipo
                                        </button>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-gray-600 mb-4">No tienes equipos asignados aún</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Gráfica de Actividad de Equipos - 1/3 del ancho -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col h-full">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900">Actividad de Equipos</h2>
            </div>
            <div class="flex-grow p-6" style="min-height: 300px;">
                <canvas id="activityChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script para Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('activityChart').getContext('2d');
        
        // Datos desde el controlador
        const labels = @json($activityData['labels']);
        const data = @json($activityData['data']);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Actividad',
                    data: data,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1.2,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
