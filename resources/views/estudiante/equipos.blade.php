@extends('layouts.estudiante')

@section('title', 'Mis Equipos - EventTec')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Equipos</h1>
            <p class="text-gray-600 text-lg">Gestiona tus equipos y colaboradores</p>
        </div>
        <button id="btn-crear-equipo" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Crear Equipo
        </button>
    </div>

    <!-- Filtros -->
    <div class="mb-6 flex gap-3">
        <button onclick="filtrarEquipos('all')" id="filter-all" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold text-sm transition-colors">
            Todos
        </button>
        <button onclick="filtrarEquipos('leader')" id="filter-leader" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200 transition-colors">
            Mis equipos (líder)
        </button>
    </div>

    <!-- Lista de equipos -->
    @if($equipos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="equipos-grid">
            @foreach($equipos as $equipo)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ strtoupper(substr($equipo->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">{{ $equipo->name }}</h3>
                                        @if($equipo->leader_id === auth()->id())
                                            <span class="inline-flex items-center px-2 py-0.5 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                                Líder
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-600">Miembro</span>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($equipo->description)
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $equipo->description }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>{{ $equipo->members_count }} {{ $equipo->members_count == 1 ? 'miembro' : 'miembros' }}</span>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $equipo->eventos_count }} {{ $equipo->eventos_count == 1 ? 'evento' : 'eventos' }}</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Líder: {{ $equipo->leader->name }}</span>
                            </div>
                        </div>

                        <a href="{{ route('estudiante.equipos.show', $equipo->id) }}" 
                           class="block w-full py-3 px-4 bg-gray-900 text-white text-center rounded-xl hover:bg-gray-800 transition-colors font-semibold">
                            Ver detalles
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No tienes equipos</h3>
            <p class="text-gray-600 mb-6">Crea tu primer equipo para participar en eventos</p>
            <button onclick="document.getElementById('btn-crear-equipo').click()" 
                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Crear equipo
            </button>
        </div>
    @endif
</div>

<!-- Modal Crear Equipo -->
<div id="modal-crear-equipo" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 relative">
        <button id="btn-cerrar-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h3 class="text-2xl font-bold text-gray-900 mb-2">Crear Nuevo Equipo</h3>
        <p class="text-gray-600 mb-6">Forma tu equipo para participar en eventos</p>

        <form id="form-crear-equipo" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del equipo *</label>
                <input type="text" 
                       name="team_name" 
                       required
                       placeholder="Ej: Tech Innovators"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción (opcional)</label>
                <textarea name="description" 
                          rows="3"
                          placeholder="Describe tu equipo..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                <p class="text-sm text-blue-800">
                    <strong>💡 Nota:</strong> Tu equipo podrá participar en múltiples eventos. Después de crearlo, podrás inscribirlo a los eventos que desees.
                </p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" 
                        id="btn-cancelar"
                        class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-semibold">
                    Cancelar
                </button>
                <button type="submit" 
                        class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors font-semibold">
                    Crear equipo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal-crear-equipo');
    const btnCrear = document.getElementById('btn-crear-equipo');
    const btnCerrar = document.getElementById('btn-cerrar-modal');
    const btnCancelar = document.getElementById('btn-cancelar');
    const form = document.getElementById('form-crear-equipo');
    
    if (btnCrear) {
        btnCrear.addEventListener('click', () => modal.classList.remove('hidden'));
    }
    
    function cerrarModal() {
        modal.classList.add('hidden');
        form.reset();
    }
    
    if (btnCerrar) btnCerrar.addEventListener('click', cerrarModal);
    if (btnCancelar) btnCancelar.addEventListener('click', cerrarModal);
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) cerrarModal();
    });
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const btn = form.querySelector('button[type="submit"]');
        
        btn.disabled = true;
        btn.textContent = 'Creando...';
        
        try {
            const response = await fetch('{{ route("estudiante.equipos.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                alert('✓ ' + data.message);
                window.location.reload();
            } else {
                alert('✗ ' + data.message);
                btn.disabled = false;
                btn.textContent = 'Crear equipo';
            }
        } catch (error) {
            alert('✗ Error al crear el equipo');
            btn.disabled = false;
            btn.textContent = 'Crear equipo';
        }
    });
});

function filtrarEquipos(tipo) {
    const filterAll = document.getElementById('filter-all');
    const filterLeader = document.getElementById('filter-leader');
    
    if (tipo === 'all') {
        filterAll.className = 'px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold text-sm transition-colors';
        filterLeader.className = 'px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200 transition-colors';
        window.location.href = '{{ route("estudiante.equipos") }}';
    } else {
        filterAll.className = 'px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200 transition-colors';
        filterLeader.className = 'px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold text-sm transition-colors';
        window.location.href = '{{ route("estudiante.equipos") }}?role=leader';
    }
}
</script>
@endsection
