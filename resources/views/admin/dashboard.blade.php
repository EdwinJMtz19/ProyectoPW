@extends('layouts.dashboard')

@section('title', 'Dashboard - Administrador')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard de Administrador</h1>
    <p class="text-gray-600">Bienvenido, {{ Auth::user()->name }}</p>
    
    <div class="mt-8 bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
        <p class="text-gray-700">Panel de administrador en construcción...</p>
    </div>
</div>
@endsection
