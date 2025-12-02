<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - EvenTec</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-xl w-full max-w-md p-8">
        
        <!-- Logo y Título -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-black rounded-2xl mb-4">
                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">EvenTec</h1>
            <p class="text-gray-600 text-sm">Plataforma de Gestión de Concursos Académicos</p>
        </div>

        <!-- Tabs: Iniciar sesión / Modo Demo -->
        <div class="flex gap-2 mb-6 bg-gray-100 p-1 rounded-xl">
            <button onclick="showLoginTab()" id="loginTab" class="flex-1 py-2 px-4 rounded-lg font-medium text-sm transition-all bg-white text-gray-900 shadow-sm">
                Iniciar sesión
            </button>
            <button onclick="showDemoTab()" id="demoTab" class="flex-1 py-2 px-4 rounded-lg font-medium text-sm transition-all text-gray-600 hover:text-gray-900">
                Modo Demo
            </button>
        </div>

        <!-- Mensajes de error -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-red-700 mb-1">Credenciales inválidas. Usa uno de los emails de demostración.</p>
                    @foreach ($errors->all() as $error)
                        <p class="text-xs text-red-600">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Contenido del Tab: Login -->
        <div id="loginContent">
            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Correo Electrónico -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Correo electrónico
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition"
                            placeholder="cheluisruiz8@gmail.com"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition"
                            placeholder="••••••••"
                            required
                        >
                    </div>
                </div>

                <!-- Botón de Login -->
                <button 
                    type="submit" 
                    class="w-full bg-black text-white font-semibold py-3 rounded-xl hover:bg-gray-800 transition duration-300 shadow-lg"
                >
                    Iniciar sesión
                </button>
            </form>

            <!-- Enlace a Registro -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    ¿No tienes cuenta? 
                    <a href="{{ route('register') }}" class="text-black font-semibold hover:underline">
                        Regístrate aquí
                    </a>
                </p>
            </div>
        </div>

        <!-- Contenido del Tab: Demo -->
        <div id="demoContent" class="hidden">
            <div class="space-y-4">
                <p class="text-sm text-gray-600 mb-4">Selecciona un usuario de demostración para probar la plataforma:</p>

                <!-- Estudiante -->
                <form method="POST" action="{{ route('login') }}" class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl border-2 border-blue-200">
                    @csrf
                    <input type="hidden" name="email" value="carlos@estudiante.com">
                    <input type="hidden" name="password" value="password123">
                    
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Estudiante</p>
                                <p class="text-xs text-gray-600">carlos@estudiante.com</p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition-colors text-sm">
                        Ingresar como Estudiante
                    </button>
                </form>

                <!-- Maestro -->
                <form method="POST" action="{{ route('login') }}" class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl border-2 border-green-200">
                    @csrf
                    <input type="hidden" name="email" value="juan@maestro.com">
                    <input type="hidden" name="password" value="password123">
                    
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Maestro</p>
                                <p class="text-xs text-gray-600">juan@maestro.com</p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-lg transition-colors text-sm">
                        Ingresar como Maestro
                    </button>
                </form>

                <!-- Juez -->
                <form method="POST" action="{{ route('login') }}" class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border-2 border-purple-200">
                    @csrf
                    <input type="hidden" name="email" value="maria@juez.com">
                    <input type="hidden" name="password" value="password123">
                    
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Juez</p>
                                <p class="text-xs text-gray-600">maria@juez.com</p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 rounded-lg transition-colors text-sm">
                        Ingresar como Juez
                    </button>
                </form>

                <!-- Admin -->
                <form method="POST" action="{{ route('login') }}" class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-xl border-2 border-red-200">
                    @csrf
                    <input type="hidden" name="email" value="admin@eventec.com">
                    <input type="hidden" name="password" value="admin123">
                    
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Administrador</p>
                                <p class="text-xs text-gray-600">admin@eventec.com</p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 rounded-lg transition-colors text-sm">
                        Ingresar como Admin
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showLoginTab() {
            document.getElementById('loginTab').classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            document.getElementById('loginTab').classList.remove('text-gray-600');
            document.getElementById('demoTab').classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
            document.getElementById('demoTab').classList.add('text-gray-600');
            
            document.getElementById('loginContent').classList.remove('hidden');
            document.getElementById('demoContent').classList.add('hidden');
        }

        function showDemoTab() {
            document.getElementById('demoTab').classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            document.getElementById('demoTab').classList.remove('text-gray-600');
            document.getElementById('loginTab').classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
            document.getElementById('loginTab').classList.add('text-gray-600');
            
            document.getElementById('demoContent').classList.remove('hidden');
            document.getElementById('loginContent').classList.add('hidden');
        }
    </script>
</body>
</html>
