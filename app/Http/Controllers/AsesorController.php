<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Project;
use App\Models\Event;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class AsesorController extends Controller
{
    /**
     * Mostrar el dashboard del asesor
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Obtener equipos donde el usuario es miembro con rol de asesor
        // O todos los equipos si es maestro
        $equipos = Team::whereHas('members', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->withCount('members')->get();
        
        // Obtener proyectos de los equipos del asesor
        $proyectos = Project::whereIn('team_id', $equipos->pluck('id'))
            ->where('status', 'active')
            ->count();
        
        // Obtener eventos activos
        $eventos = Event::where('status', 'upcoming')
            ->orWhere('status', 'ongoing')
            ->count();
        
        // Obtener notificaciones del asesor
        $notificaciones = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
        
        // Datos para la gráfica de actividad (simulados por ahora, pueden ser reales después)
        $activityData = [
            'labels' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
            'data' => [12, 19, 30, 45, 38, 55]
        ];
        
        return view('asesor.dashboard', compact(
            'equipos',
            'proyectos',
            'eventos',
            'notificaciones',
            'activityData'
        ));
    }

    /**
     * Mostrar la lista de eventos
     */
    public function eventos()
    {
        // Obtener todos los eventos ordenados por fecha
        $eventos = Event::orderBy('event_start_date', 'desc')->get();
        
        // Contar eventos por estado
        $todosCount = $eventos->count();
        $activosCount = $eventos->where('status', 'ongoing')->count();
        $proximosCount = $eventos->where('status', 'upcoming')->count();
        $finalizadosCount = $eventos->where('status', 'completed')->count();
        
        return view('asesor.eventos', compact(
            'eventos',
            'todosCount',
            'activosCount',
            'proximosCount',
            'finalizadosCount'
        ));
    }

    /**
     * Mostrar el detalle de un evento
     */
    public function eventoDetalle($id)
    {
        $evento = Event::with(['schedule'])
            ->where('id', $id)
            ->firstOrFail();
        
        // Contar equipos registrados
        $equiposCount = Team::where('event_id', $id)->count();
        
        return view('asesor.evento-detalle', compact('evento', 'equiposCount'));
    }

    /**
     * Mostrar la lista de equipos
     */
    public function equipos()
    {
        $user = Auth::user();
        
        // Obtener equipos donde el usuario es miembro
        $equipos = Team::whereHas('members', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['members', 'event', 'project'])
        ->withCount('members')
        ->get();
        
        // Obtener todos los eventos para el selector
        $eventos = Event::where('status', '!=', 'completed')
            ->orderBy('event_start_date', 'desc')
            ->get();
        
        return view('asesor.equipos', compact('equipos', 'eventos'));
    }

    /**
     * Mostrar la lista de proyectos
     */
    public function proyectos()
    {
        $user = Auth::user();
        
        // Obtener proyectos de los equipos donde el usuario es miembro (asesor)
        $proyectos = Project::whereHas('team.members', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['team.members', 'team.event'])
        ->get();
        
        // Contar proyectos por estado
        $todosCount = $proyectos->count();
        $enProgresoCount = $proyectos->whereIn('status', ['draft', 'in_progress'])->count();
        $entregadosCount = $proyectos->where('status', 'submitted')->count();
        $evaluadosCount = $proyectos->where('status', 'evaluated')->count();
        
        return view('asesor.proyectos', compact(
            'proyectos',
            'todosCount',
            'enProgresoCount',
            'entregadosCount',
            'evaluadosCount'
        ));
    }

    /**
     * Mostrar los rankings
     */
    public function rankings()
    {
        // Obtener proyectos con puntajes ordenados
        $rankings = Project::with(['team.members', 'team.event'])
            ->whereNotNull('final_score')
            ->orderBy('rank', 'asc')
            ->get();
        
        return view('asesor.rankings', compact('rankings'));
    }

    /**
     * Mostrar el perfil del asesor
     */
    public function miPerfil()
    {
        $user = Auth::user();
        
        // Obtener estadísticas del asesor
        $equipos = Team::whereHas('members', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        
        $proyectos = Project::whereHas('team.members', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        
        return view('asesor.mi-perfil', compact('user', 'equipos', 'proyectos'));
    }
}
