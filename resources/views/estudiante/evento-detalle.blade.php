@extends('layouts.dashboard')

@section('title', 'Detalle del Evento - EventTecNM')

@section('content')
<div class="p-8">
    <!-- Botón de regresar -->
    <a href="{{ route('estudiante.eventos') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        <span>Volver a Eventos</span>
    </a>

    @php
        // Datos estáticos de eventos (más adelante vendrán de la BD)
        $eventos = [
            1 => [
                'titulo' => 'HackCatec 2025',
                'tipo' => 'Hackatón',
                'categoria' => 'Software',
                'status' => 'En Curso',
                'status_color' => 'red',
                'descripcion' => 'Gran competencia de hackatón regional, enfocado en soluciones tecnológicas innovadoras para problemas sociales y empresariales. Los participantes tendrán 48 horas para desarrollar prototipos funcionales que demuestren creatividad, viabilidad técnica y potencial de impacto.',
                'fecha_registro_inicio' => '20 de Noviembre, 2024',
                'fecha_registro_fin' => '15 de Diciembre, 2024',
                'fecha_evento' => '10-12 de Enero, 2025',
                'ubicacion' => 'Auditorio Principal - Edificio A',
                'requisitos' => [
                    'Ser estudiante activo del TecNM',
                    'Formar equipos de 3-5 integrantes',
                    'Tener conocimientos básicos de programación',
                    'Laptop personal con herramientas de desarrollo'
                ],
                'premios' => [
                    '1er Lugar: $20,000 MXN + Mentorías',
                    '2do Lugar: $12,000 MXN + Reconocimiento',
                    '3er Lugar: $8,000 MXN + Reconocimiento',
                    'Mejor innovación tecnológica: $5,000 MXN'
                ],
                'organizador' => 'Departamento de Sistemas y Computación',
                'contacto' => 'hackcatec@tecnm.mx'
            ],
            2 => [
                'titulo' => 'InovaTec',
                'tipo' => 'Competencia',
                'categoria' => 'Innovación',
                'status' => 'Próximamente',
                'status_color' => 'blue',
                'descripcion' => 'Feria de innovación tecnológica donde los equipos presentarán prototipos de proyectos innovadores enfocados en resolver problemáticas actuales mediante la tecnología. Se evaluará creatividad, viabilidad técnica, presentación y potencial de impacto.',
                'fecha_registro_inicio' => '01 de Enero, 2025',
                'fecha_registro_fin' => '28 de Febrero, 2025',
                'fecha_evento' => '15-17 de Marzo, 2025',
                'ubicacion' => 'Campus TecNM - Plaza Central',
                'requisitos' => [
                    'Estudiantes de todas las carreras',
                    'Equipos de 2-4 personas',
                    'Proyecto innovador funcional',
                    'Presentación de pitch (5 minutos)'
                ],
                'premios' => [
                    '1er Lugar: $15,000 MXN + Incubación',
                    '2do Lugar: $10,000 MXN + Asesoría',
                    '3er Lugar: $6,000 MXN',
                    'Premio del Público: $3,000 MXN'
                ],
                'organizador' => 'Centro de Innovación y Emprendimiento',
                'contacto' => 'inovatec@tecnm.mx'
            ],
            3 => [
                'titulo' => 'CodeChallenge 2026',
                'tipo' => 'Competencia',
                'categoria' => 'Programación',
                'status' => 'Próximamente',
                'status_color' => 'green',
                'descripcion' => 'Maratón de programación con problemas algorítmicos y de desarrollo de software. Los participantes resolverán desafíos de creciente dificultad, demostrando sus habilidades en algoritmos, estructuras de datos y optimización de código.',
                'fecha_registro_inicio' => '01 de Marzo, 2026',
                'fecha_registro_fin' => '30 de Abril, 2026',
                'fecha_evento' => '15-16 de Mayo, 2026',
                'ubicacion' => 'Laboratorio de Cómputo - Edificio C',
                'requisitos' => [
                    'Conocimientos en al menos un lenguaje de programación',
                    'Participación individual o en parejas',
                    'Computadora personal',
                    'Conocimientos de algoritmos y estructuras de datos'
                ],
                'premios' => [
                    '1er Lugar: Laptop + Certificación internacional',
                    '2do Lugar: Tablet + Cursos en línea',
                    '3er Lugar: Auriculares gaming + Libros',
                    'Mejor código limpio: $2,000 MXN'
                ],
                'organizador' => 'Club de Programación Competitiva',
                'contacto' => 'codechallenge@tecnm.mx'
            ],
            4 => [
                'titulo' => 'AI Workshop Series',
                'tipo' => 'Taller',
                'categoria' => 'Inteligencia Artificial',
                'status' => 'Finalizado',
                'status_color' => 'gray',
                'descripcion' => 'Serie de talleres sobre inteligencia artificial, machine learning y desarrollo de aplicaciones con IA. Los participantes aprendieron desde conceptos básicos hasta implementaciones prácticas de modelos de aprendizaje automático.',
                'fecha_registro_inicio' => '15 de Agosto, 2024',
                'fecha_registro_fin' => '31 de Agosto, 2024',
                'fecha_evento' => '01 de Septiembre - 30 de Octubre, 2024',
                'ubicacion' => 'Centro de Innovación - Sala de Talleres',
                'requisitos' => [
                    'Conocimientos básicos de Python',
                    'Laptop con 8GB RAM mínimo',
                    'Interés en Inteligencia Artificial',
                    'Asistencia al 80% de las sesiones'
                ],
                'premios' => [
                    'Certificado de participación',
                    'Diploma de aprovechamiento (calificación >80)',
                    'Material didáctico digital',
                    'Acceso a comunidad de IA'
                ],
                'organizador' => 'Laboratorio de Inteligencia Artificial',
                'contacto' => 'aiworkshop@tecnm.mx'
            ]
        ];

        $evento = $eventos[$id] ?? $eventos[1];
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Header del Evento -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-200">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="px-3 py-1 bg-{{ $evento['status_color'] }}-100 text-{{ $evento['status_color'] }}-700 text-xs font-semibold rounded-full">
                            {{ $evento['status'] }}
                        </span>
                    </div>
                    <span class="text-sm text-gray-500">{{ $evento['tipo'] }}</span>
                </div>

                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $evento['titulo'] }}</h1>
                <p class="text-lg text-gray-600 mb-6">{{ $evento['categoria'] }}</p>

                <!-- Descripción -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-3">Descripción del Evento</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $evento['descripcion'] }}</p>
                </div>

                <!-- Fechas Importantes -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-3">📅 Fechas Importantes</h2>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3 p-4 bg-blue-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-800">Registro</p>
                                <p class="text-sm text-gray-600">{{ $evento['fecha_registro_inicio'] }} - {{ $evento['fecha_registro_fin'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 bg-green-50 rounded-lg">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-800">Fecha del Evento</p>
                                <p class="text-sm text-gray-600">{{ $evento['fecha_evento'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-4 bg-purple-50 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-800">Ubicación</p>
                                <p class="text-sm text-gray-600">{{ $evento['ubicacion'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Requisitos -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-3">📋 Requisitos</h2>
                    <ul class="space-y-2">
                        @foreach($evento['requisitos'] as $requisito)
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">{{ $requisito }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Premios -->
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-3">🏆 Premios</h2>
                    <div class="space-y-3">
                        @foreach($evento['premios'] as $premio)
                        <div class="flex items-start gap-3 p-4 bg-yellow-50 rounded-lg">
                            <span class="text-2xl">🏅</span>
                            <p class="text-gray-700 font-medium">{{ $premio }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna Lateral -->
        <div class="space-y-6">
            <!-- Card de Registro -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 sticky top-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Registro al Evento</h3>
                
                @if($evento['status'] == 'Finalizado')
                    <div class="bg-gray-100 text-center py-8 rounded-xl mb-4">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-600 font-medium">Este evento ya finalizó</p>
                    </div>
                @else
                    <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4 mb-4">
                        <p class="text-sm text-blue-800 font-medium mb-2">✨ ¡Inscripciones abiertas!</p>
                        <p class="text-xs text-blue-600">No pierdas la oportunidad de participar</p>
                    </div>

                    <button class="w-full bg-blue-900 text-white py-4 rounded-xl font-bold hover:bg-blue-800 transition-colors shadow-md mb-3">
                        Registrarme al Evento
                    </button>
                @endif

                <!-- Información de Contacto -->
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <h4 class="font-semibold text-gray-800 mb-3">Información de Contacto</h4>
                    <div class="space-y-2">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Organiza:</p>
                                <p class="text-sm text-gray-600">{{ $evento['organizador'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Email:</p>
                                <p class="text-sm text-blue-600">{{ $evento['contacto'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Compartir -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <h3 class="font-bold text-gray-800 mb-4">Compartir Evento</h3>
                <div class="flex gap-2">
                    <button class="flex-1 bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors text-sm">
                        Facebook
                    </button>
                    <button class="flex-1 bg-sky-400 text-white py-2 rounded-lg hover:bg-sky-500 transition-colors text-sm">
                        Twitter
                    </button>
                    <button class="flex-1 bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors text-sm">
                        WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
