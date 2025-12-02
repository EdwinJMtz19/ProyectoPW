<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Juez - EventTecNM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-purple-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">EventTecNM</h1>
                <p class="text-sm opacity-90">Portal del Juez</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-xs opacity-75">{{ auth()->user()->numero_control }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container mx-auto px-4 py-8">
        <!-- Bienvenida -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">
                ¡Bienvenido, {{ auth()->user()->name }}!
            </h2>
            <p class="text-gray-600">
                Rol: <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                    👨‍⚖️ Juez
                </span>
            </p>
        </div>

        <!-- Grid de tarjetas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tarjeta 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Evaluar Proyectos</h3>
                    <span class="text-3xl">📝</span>
                </div>
                <p class="text-gray-600 mb-4">Califica los proyectos asignados</p>
                <button class="w-full bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 rounded-lg transition">
                    Ver Proyectos
                </button>
            </div>

            <!-- Tarjeta 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Mis Evaluaciones</h3>
                    <span class="text-3xl">⭐</span>
                </div>
                <p class="text-gray-600 mb-4">Revisa evaluaciones realizadas</p>
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded-lg transition">
                    Ver Evaluaciones
                </button>
            </div>

            <!-- Tarjeta 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Eventos Asignados</h3>
                    <span class="text-3xl">🏆</span>
                </div>
                <p class="text-gray-600 mb-4">Eventos donde participas como juez</p>
                <button class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-lg transition">
                    Ver Eventos
                </button>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="mt-8 bg-purple-50 border border-purple-200 rounded-lg p-6">
            <h3 class="text-lg font-bold text-purple-800 mb-2">👨‍⚖️ Panel de Evaluación</h3>
            <p class="text-purple-700">
                Como juez, tu rol es evaluar de manera objetiva e imparcial los proyectos participantes en los eventos.
            </p>
        </div>
    </div>
</body>
</html>
