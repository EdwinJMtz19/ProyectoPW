@extends('layouts.dashboard')

@section('title', 'Mi Progreso - EventTecNM')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Mi Progreso</h1>
    <p class="text-gray-600 mb-8">Revisa tu rendimiento académico y participación en eventos</p>
    
    <div class="bg-white rounded-2xl p-12 shadow-sm border border-gray-200 text-center">
        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Sección en construcción</h2>
        <p class="text-gray-600">Pronto podrás ver tu progreso y estadísticas aquí</p>
    </div>
</div>
@endsection
