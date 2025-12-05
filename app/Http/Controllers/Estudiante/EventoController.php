<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('is_published', true);

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $eventos = $query->orderBy('event_start_date', 'desc')->get();

        if ($request->ajax()) {
            return response()->json($eventos);
        }

        return view('estudiante.eventos', compact('eventos'));
    }

    public function show($id)
    {
        $evento = Event::with(['schedule' => function($query) {
            $query->orderBy('day')->orderBy('order_index');
        }])->findOrFail($id);

        $evento->increment('views_count');

        $user = Auth::user();
        
        // Obtener TODOS los equipos del usuario (sin filtrar por evento)
        $misEquipos = Team::whereHas('members', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        
        // Verificar si alguno de sus equipos ya está inscrito en ESTE evento
        $equipoInscritoRegistro = DB::table('event_registrations')
            ->where('event_id', $id)
            ->whereIn('team_id', $misEquipos->pluck('id'))
            ->first();
        
        // Obtener equipos inscritos en el evento
        $registrations = DB::table('event_registrations')
            ->where('event_id', $id)
            ->get();
        
        $equiposInscritos = collect();
        
        foreach ($registrations as $reg) {
            $team = Team::with(['leader', 'members'])->find($reg->team_id);
            if ($team) {
                $team->registered_at = $reg->registered_at;
                $equiposInscritos->push($team);
            }
        }
        
        // Si no hay en event_registrations, buscar en el sistema antiguo
        if ($equiposInscritos->count() == 0) {
            $equiposInscritos = Team::where('event_id', $id)
                ->with(['leader', 'members'])
                ->get();
                
            // Verificar si el usuario tiene equipo en sistema antiguo
            if (!$equipoInscritoRegistro) {
                $equipoInscritoRegistro = $equiposInscritos->first(function($equipo) use ($user) {
                    return $equipo->members->contains('id', $user->id);
                });
            }
        }
        
        // Obtener solicitudes pendientes del usuario
        $solicitudesPendientes = [];
        if (!$equipoInscritoRegistro) {
            $solicitudesPendientes = DB::table('join_requests')
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->whereIn('team_id', $equiposInscritos->pluck('id'))
                ->pluck('team_id')
                ->toArray();
        }

        // Determinar si el usuario tiene equipo inscrito
        $miEquipo = null;
        if ($equipoInscritoRegistro) {
            // Obtener el team_id del registro
            $teamId = $equipoInscritoRegistro->team_id;
            
            // Buscar el objeto Team completo
            $miEquipo = $misEquipos->firstWhere('id', $teamId);
            
            // Si no está en misEquipos (por alguna razón), buscarlo directamente
            if (!$miEquipo) {
                $miEquipo = Team::find($teamId);
            }
        }

        return view('estudiante.evento-detalle', compact('evento', 'miEquipo', 'misEquipos', 'equiposInscritos', 'solicitudesPendientes'));
    }

    public function inscribirEquipo(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'team_id' => 'required|exists:teams,id',
            'project_title' => 'required|string|max:255',
            'project_description' => 'required|string|max:2000',
        ]);

        $user = Auth::user();
        $team = Team::findOrFail($request->team_id);
        $event = Event::findOrFail($request->event_id);

        // Verificar que el usuario es miembro del equipo
        if (!$team->isMember($user->id)) {
            return response()->json(['success' => false, 'message' => 'No eres miembro de este equipo'], 403);
        }

        // Verificar que el equipo no esté ya inscrito en este evento
        $registroExistente = DB::table('event_registrations')
            ->where('team_id', $request->team_id)
            ->where('event_id', $request->event_id)
            ->first();

        if ($registroExistente) {
            return response()->json(['success' => false, 'message' => 'Este equipo ya está inscrito en este evento'], 422);
        }

        // Verificar límite de equipos en el evento
        if ($event->max_teams) {
            $equiposInscritos = DB::table('event_registrations')
                ->where('event_id', $request->event_id)
                ->count();
            
            if ($equiposInscritos >= $event->max_teams) {
                return response()->json(['success' => false, 'message' => 'El evento ha alcanzado el límite de equipos'], 422);
            }
        }

        try {
            DB::beginTransaction();

            // Crear proyecto
            $projectId = Str::uuid();
            DB::table('projects')->insert([
                'id' => $projectId,
                'team_id' => $request->team_id,
                'event_id' => $request->event_id,
                'title' => $request->project_title,
                'description' => $request->project_description,
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Registrar equipo en evento
            DB::table('event_registrations')->insert([
                'id' => Str::uuid(),
                'team_id' => $request->team_id,
                'event_id' => $request->event_id,
                'project_id' => $projectId,
                'registered_by' => $user->id,
                'registered_at' => now(),
            ]);

            // Incrementar contador de equipos registrados
            $event->increment('registered_teams_count');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Equipo inscrito al evento exitosamente',
                'project_id' => $projectId
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function registrarEquipo(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'team_name' => 'required|string|max:255',
            'team_description' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $evento = Event::findOrFail($request->event_id);

        // Verificar límite de equipos en el evento
        if ($evento->max_teams) {
            $equiposInscritos = DB::table('event_registrations')
                ->where('event_id', $request->event_id)
                ->count();
            
            if ($equiposInscritos >= $evento->max_teams) {
                return response()->json([
                    'success' => false,
                    'message' => 'El evento ha alcanzado el límite máximo de equipos'
                ], 422);
            }
        }

        try {
            DB::beginTransaction();

            // Crear equipo SIN event_id (equipos independientes)
            $teamId = Str::uuid();
            $team = Team::create([
                'id' => $teamId,
                'name' => $request->team_name,
                'description' => $request->team_description,
                'event_id' => null, // Equipo independiente
                'leader_id' => $user->id,
                'status' => 'active',
                'members_count' => 1,
            ]);

            // Agregar al usuario como líder
            DB::table('team_members')->insert([
                'id' => Str::uuid(),
                'team_id' => $teamId,
                'user_id' => $user->id,
                'role' => 'leader',
                'joined_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Equipo creado exitosamente. Ahora inscríbelo al evento.',
                'team' => $team,
                'team_id' => $teamId
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el equipo: ' . $e->getMessage()
            ], 500);
        }
    }

    public function solicitarUnirse(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $user = Auth::user();
        $team = Team::with(['leader'])->findOrFail($request->team_id);

        // Verificar si ya envió solicitud
        $solicitudExistente = DB::table('join_requests')
                                 ->where('team_id', $team->id)
                                 ->where('user_id', $user->id)
                                 ->where('status', 'pending')
                                 ->first();

        if ($solicitudExistente) {
            return response()->json([
                'success' => false,
                'message' => 'Ya enviaste una solicitud a este equipo'
            ], 422);
        }

        try {
            // Crear solicitud
            DB::table('join_requests')->insert([
                'id' => Str::uuid(),
                'team_id' => $team->id,
                'user_id' => $user->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Crear notificación para el líder
            Notification::create([
                'id' => Str::uuid(),
                'user_id' => $team->leader_id,
                'type' => 'join_request',
                'title' => 'Nueva solicitud de unión',
                'message' => $user->name . ' quiere unirse a tu equipo "' . $team->name . '"',
                'data' => json_encode([
                    'team_id' => $team->id,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'team_name' => $team->name,
                ]),
                'is_read' => false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud enviada al líder del equipo'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar solicitud: ' . $e->getMessage()
            ], 500);
        }
    }
}
