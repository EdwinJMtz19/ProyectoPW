@extends('layouts.dashboard')

@section('title', 'Eventos - EventTecNM')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Eventos</h1>
        <p class="text-gray-600 mt-2">Descubre y participa en los eventos del Tecnológico</p>
    </div>

    <!-- Filtros de Eventos -->
    <div class="flex gap-3 mb-8">
        <button class="px-6 py-3 bg-white text-gray-800 font-medium rounded-full shadow-sm hover:shadow-md transition-all border-2 border-gray-200 filter-btn active" data-filter="todos">
            Todos
        </button>
        <button class="px-6 py-3 bg-white text-gray-600 font-medium rounded-full hover:shadow-md transition-all border-2 border-transparent filter-btn" data-filter="proximos">
            Próximos
        </button>
        <button class="px-6 py-3 bg-white text-gray-600 font-medium rounded-full hover:shadow-md transition-all border-2 border-transparent filter-btn" data-filter="en-curso">
            En Curso
        </button>
        <button class="px-6 py-3 bg-white text-gray-600 font-medium rounded-full hover:shadow-md transition-all border-2 border-transparent filter-btn" data-filter="finalizados">
            Finalizados
        </button>
    </div>

    <!-- Grid de Eventos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Evento 1: HackCatec 2025 -->
        <div class="bg-white rounded-2xl border-2 border-gray-200 overflow-hidden hover:shadow-lg transition-all event-card" data-status="en-curso">
            <div class="p-6">
                <!-- Badge y Tipo -->
                <div class="flex items-center justify-between mb-4">
                    <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">En Curso</span>
                    <span class="text-xs text-gray-500">Hackatón</span>
                </div>

                <!-- Título -->
                <h3 class="text-xl font-bold text-gray-800 mb-2">HackCatec 2025</h3>
                
                <!-- Tipo de evento -->
                <p class="text-sm text-gray-600 mb-4">Software | Hackatón</p>

                <!-- Descripción -->
                <p class="text-sm text-gray-600 mb-4">
                    Gran competencia de hackatón regional, enfocado en soluciones tecnológicas innovadoras para...
                </p>

                <!-- Fechas -->
                <div class="space-y-2 mb-4">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Registro: 20 Nov - 15 Dic</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Auditorio Principal</span>
                    </div>
                </div>

                <!-- Premios -->
                <div class="mb-4">
                    <p class="text-xs font-semibold text-gray-700 mb-2">🏆 Premios</p>
                    <div class="flex gap-1">
                        <span class="text-xl">💰</span>
                        <span class="text-xl">🏅</span>
                        <span class="text-xl">🎓</span>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex gap-2">
                    <a href="{{ route('estudiante.evento.detalle', 1) }}" class="flex-1 bg-gray-100 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors text-center text-sm">
                        Ver Detalles
                    </a>
                    <button class="flex-1 bg-blue-900 text-white py-2 rounded-lg font-medium hover:bg-blue-800 transition-colors text-sm">
                        Registrar
                    </button>
                </div>
            </div>
        </div>

        <!-- Evento 2: InovaTec -->
        <div class="bg-white rounded-2xl border-2 border-gray-200 overflow-hidden hover:shadow-lg transition-all event-card" data-status="proximos">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Próximamente</span>
                    <span class="text-xs text-gray-500">Competencia</span>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-2">InovaTec</h3>
                <p class="text-sm text-gray-600 mb-4">Prueba de Competencia</p>

                <p class="text-sm text-gray-600 mb-4">
                    Feria de innovación tecnológica donde los equipos determinarán prototipos de proyectos...
                </p>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Registro: 01 Ene - 28 Feb</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Campus TecNM</span>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-xs font-semibold text-gray-700 mb-2">🏆 Premios</p>
                    <div class="flex gap-1">
                        <span class="text-xl">💰</span>
                        <span class="text-xl">📜</span>
                        <span class="text-xl">🎁</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('estudiante.evento.detalle', 2) }}" class="flex-1 bg-gray-100 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors text-center text-sm">
                        Ver Detalles
                    </a>
                    <button class="flex-1 bg-blue-900 text-white py-2 rounded-lg font-medium hover:bg-blue-800 transition-colors text-sm">
                        Registrar
                    </button>
                </div>
            </div>
        </div>

        <!-- Evento 3: CodeChallenge 2026 -->
        <div class="bg-white rounded-2xl border-2 border-gray-200 overflow-hidden hover:shadow-lg transition-all event-card" data-status="proximos">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Próximamente</span>
                    <span class="text-xs text-gray-500">Competencia</span>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-2">CodeChallenge 2026</h3>
                <p class="text-sm text-gray-600 mb-4">Evento de Competencia</p>

                <p class="text-sm text-gray-600 mb-4">
                    Maratón de programación con problemas algorítmicos y de desarrollo de software...
                </p>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Registro: 01 Mar - 30 Abr</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Laboratorio de Cómputo</span>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-xs font-semibold text-gray-700 mb-2">🏆 Premios</p>
                    <div class="flex gap-1">
                        <span class="text-xl">🏆</span>
                        <span class="text-xl">💻</span>
                        <span class="text-xl">🎖️</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('estudiante.evento.detalle', 3) }}" class="flex-1 bg-gray-100 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors text-center text-sm">
                        Ver Detalles
                    </a>
                    <button class="flex-1 bg-blue-900 text-white py-2 rounded-lg font-medium hover:bg-blue-800 transition-colors text-sm">
                        Registrar
                    </button>
                </div>
            </div>
        </div>

        <!-- Evento 4: AI Workshop Series -->
        <div class="bg-white rounded-2xl border-2 border-gray-200 overflow-hidden hover:shadow-lg transition-all event-card" data-status="finalizados">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-3 py-1 bg-gray-200 text-gray-700 text-xs font-semibold rounded-full">Finalizado</span>
                    <span class="text-xs text-gray-500">Taller</span>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-2">AI Workshop Series</h3>
                <p class="text-sm text-gray-600 mb-4">Finalizado | Taller</p>

                <p class="text-sm text-gray-600 mb-4">
                    Serie de talleres sobre inteligencia artificial, machine learning y desarrollo de aplicaciones...
                </p>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Realizado: 01 Sep - 30 Oct</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Centro de Innovación</span>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-xs font-semibold text-gray-700 mb-2">🏆 Premios</p>
                    <div class="flex gap-1">
                        <span class="text-xl">📜</span>
                        <span class="text-xl">🎓</span>
                        <span class="text-xl">📚</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('estudiante.evento.detalle', 4) }}" class="flex-1 bg-gray-100 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors text-center text-sm">
                        Ver Detalles
                    </a>
                    <button class="flex-1 bg-gray-300 text-gray-500 py-2 rounded-lg font-medium cursor-not-allowed text-sm" disabled>
                        Finalizado
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Filtrado de eventos
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remover clase active de todos los botones
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active', 'border-gray-200', 'text-gray-800');
                b.classList.add('text-gray-600', 'border-transparent');
            });
            
            // Agregar clase active al botón clickeado
            this.classList.add('active', 'border-gray-200', 'text-gray-800');
            this.classList.remove('text-gray-600', 'border-transparent');
            
            const filter = this.dataset.filter;
            const cards = document.querySelectorAll('.event-card');
            
            cards.forEach(card => {
                if (filter === 'todos') {
                    card.style.display = 'block';
                } else {
                    if (card.dataset.status === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
</script>
@endsection
