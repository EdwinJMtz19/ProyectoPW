<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - EventTecNM')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-50 to-blue-100 flex flex-col shadow-lg">
            <!-- Header del Sidebar -->
            <div class="p-6 border-b border-blue-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-blue-900 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">EventTecNM</h3>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-3 shadow-sm">
                    <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        @if(Auth::user()->isEstudiante())
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">Estudiante</span>
                        @elseif(Auth::user()->isDocente())
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">Docente</span>
                        @else
                            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full text-xs">Admin</span>
                        @endif
                    </p>
                    <p class="text-xs text-gray-600 mt-1">{{ Auth::user()->numero_control }}</p>
                </div>
            </div>

            <!-- Navegación Principal -->
            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('estudiante.dashboard') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('estudiante.dashboard') ? 'bg-white text-blue-900 shadow-sm font-semibold' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estudiante.eventos') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('estudiante.eventos*') ? 'bg-white text-blue-900 shadow-sm font-semibold' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Eventos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estudiante.mi-equipo') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('estudiante.mi-equipo') ? 'bg-white text-blue-900 shadow-sm font-semibold' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span>Mi Equipo</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-gray-700 hover:bg-white hover:shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Crear Equipo</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estudiante.mi-progreso') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('estudiante.mi-progreso') ? 'bg-white text-blue-900 shadow-sm font-semibold' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <span>Mi Progreso</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estudiante.constancias') }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('estudiante.constancias') ? 'bg-white text-blue-900 shadow-sm font-semibold' : 'text-gray-700 hover:bg-white hover:shadow-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Constancias</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer del Sidebar -->
            <div class="p-4 border-t border-blue-200">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-white hover:shadow-sm transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Configuración</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 hover:shadow-sm transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span>Cerrar Sesión</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>
