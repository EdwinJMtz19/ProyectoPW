<?php

/**
 * EJEMPLO DE INTEGRACIÓN DE EMAILS EN ADMINCONTROLLER
 *
 * Este archivo muestra ejemplos de cómo integrar el envío de emails
 * en los métodos existentes del AdminController.
 *
 * NO ejecutar este archivo, solo es de referencia.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Evaluation;
use App\Models\EventJudge;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

// Importar los Mailables
use App\Mail\WelcomeMail;
use App\Mail\EventCreatedMail;
use App\Mail\JudgeAssignedMail;

// Importar los Form Requests
use App\Http\Requests\Admin\StoreEventoRequest;
use App\Http\Requests\Admin\UpdateEventoRequest;
use App\Http\Requests\Admin\AsignarJuecesRequest;
use App\Http\Requests\Admin\AsignarAsesoresRequest;
use App\Http\Requests\Admin\StoreUsuarioRequest;
use App\Http\Requests\Admin\UpdateUsuarioRequest;
use App\Http\Requests\Admin\UpdatePerfilRequest;
use App\Http\Requests\Admin\UpdatePasswordRequest;

class AdminControllerConEmails extends Controller
{
    /**
     * EJEMPLO 1: Crear un nuevo usuario y enviar email de bienvenida
     */
    public function crearUsuario(StoreUsuarioRequest $request)
    {
        $usuario = User::create([
            'id' => (string) Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'numero_control' => $request->numero_control,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'is_active' => true,
        ]);

        // ========================================
        // NUEVO: Enviar email de bienvenida
        // ========================================
        try {
            Mail::to($usuario->email)->send(new WelcomeMail($usuario));

            // Opcional: Log para debugging
            Log::info("Email de bienvenida enviado a: {$usuario->email}");
        } catch (\Exception $e) {
            // No interrumpir el flujo si falla el email
            Log::error("Error al enviar email de bienvenida: " . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * EJEMPLO 2: Crear evento y notificar a estudiantes
     */
    public function crearEvento(StoreEventoRequest $request)
    {
        // Determinar el status basado en las fechas
        $now = now()->startOfDay();
        $eventStart = \Carbon\Carbon::parse($request->event_start_date)->startOfDay();
        $eventEnd = \Carbon\Carbon::parse($request->event_end_date)->endOfDay();

        if ($now->greaterThan($eventEnd)) {
            $status = 'finished';
        } elseif ($now->between($eventStart, $eventEnd)) {
            $status = 'in_progress';
        } else {
            $status = 'upcoming';
        }

        $evento = Event::create([
            'id' => (string) Str::uuid(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'short_description' => Str::limit($request->description, 200),
            'category' => $request->category,
            'event_type' => $request->event_type ?? 'competition',
            'status' => $status,
            'registration_start_date' => $request->registration_start_date,
            'registration_end_date' => $request->registration_end_date,
            'event_start_date' => $request->event_start_date,
            'event_end_date' => $request->event_end_date,
            'min_team_size' => $request->min_team_size,
            'max_team_size' => $request->max_team_size,
            'max_teams' => $request->max_teams,
            'location' => $request->location,
            'cover_image_url' => $request->cover_image_url,
            'is_online' => $request->is_online ?? false,
            'organizer_id' => auth()->id(),
            'organizer_name' => auth()->user()->name,
            'contact_email' => auth()->user()->email,
            'is_published' => true,
        ]);

        // ========================================
        // NUEVO: Notificar a todos los estudiantes sobre el nuevo evento
        // ========================================
        try {
            // Obtener todos los estudiantes activos
            $estudiantes = User::where(function($query) {
                $query->where('user_type', 'estudiante')
                      ->orWhere('role', 'estudiante');
            })
            ->where('is_active', true)
            ->get();

            // Enviar emails (usar queue en producción para mejor rendimiento)
            foreach ($estudiantes as $estudiante) {
                // Opción 1: Envío directo (desarrollo)
                // Mail::to($estudiante->email)->send(new EventCreatedMail($evento));

                // Opción 2: Envío con cola (producción - recomendado)
                Mail::to($estudiante->email)->queue(new EventCreatedMail($evento));
            }

            Log::info("Notificaciones de evento enviadas a {$estudiantes->count()} estudiantes");
        } catch (\Exception $e) {
            Log::error("Error al enviar notificaciones de evento: " . $e->getMessage());
        }

        return redirect()->route('admin.eventos')->with('success', 'Evento creado exitosamente.');
    }

    /**
     * EJEMPLO 3: Asignar jueces y enviar notificaciones
     */
    public function asignarJueces(AsignarJuecesRequest $request, $id)
    {
        $evento = Event::findOrFail($id);

        // Eliminar asignaciones anteriores
        EventJudge::where('event_id', $id)->delete();

        // Crear nuevas asignaciones si hay jueces seleccionados
        if ($request->has('judges') && is_array($request->judges)) {
            foreach ($request->judges as $judgeId) {
                EventJudge::create([
                    'id' => (string) Str::uuid(),
                    'event_id' => $id,
                    'judge_id' => $judgeId,
                    'status' => 'active',
                    'assigned_at' => now(),
                    'assigned_by' => auth()->id(),
                ]);

                // ========================================
                // NUEVO: Enviar notificación a cada juez asignado
                // ========================================
                try {
                    $juez = User::find($judgeId);
                    if ($juez) {
                        Mail::to($juez->email)->send(new JudgeAssignedMail($juez, $evento));
                        Log::info("Notificación de juez enviada a: {$juez->email}");
                    }
                } catch (\Exception $e) {
                    Log::error("Error al enviar email a juez {$judgeId}: " . $e->getMessage());
                }
            }
        }

        return redirect()->back()->with('success', 'Jueces asignados exitosamente.');
    }

    /**
     * EJEMPLO 4: Envío masivo con límite de tasa (rate limiting)
     *
     * Este ejemplo muestra cómo enviar emails masivos respetando
     * los límites de tasa de Brevo para evitar bloqueos.
     */
    public function enviarNotificacionMasiva()
    {
        $usuarios = User::where('is_active', true)->get();
        $emailsEnviados = 0;
        $maxPorLote = 50; // Máximo de emails por lote

        try {
            foreach ($usuarios->chunk($maxPorLote) as $lote) {
                foreach ($lote as $usuario) {
                    Mail::to($usuario->email)->queue(new WelcomeMail($usuario));
                    $emailsEnviados++;
                }

                // Esperar 1 segundo entre lotes para no saturar
                if ($emailsEnviados < $usuarios->count()) {
                    sleep(1);
                }
            }

            Log::info("Envío masivo completado: {$emailsEnviados} emails en cola");

            return response()->json([
                'success' => true,
                'message' => "{$emailsEnviados} notificaciones enviadas exitosamente"
            ]);
        } catch (\Exception $e) {
            Log::error("Error en envío masivo: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al enviar notificaciones'
            ], 500);
        }
    }

    /**
     * EJEMPLO 5: Envío con CC y BCC
     */
    public function enviarEmailConCopias()
    {
        $usuario = User::first();
        $evento = Event::first();

        try {
            Mail::to($usuario->email)
                ->cc('admin@eventtecnm.com')  // Copia
                ->bcc('backup@eventtecnm.com') // Copia oculta
                ->send(new EventCreatedMail($evento));

            return "Email enviado con copias";
        } catch (\Exception $e) {
            Log::error("Error: " . $e->getMessage());
            return "Error al enviar email";
        }
    }

    /**
     * EJEMPLO 6: Verificar antes de enviar
     */
    public function enviarEmailConValidacion(User $usuario, Event $evento)
    {
        // Verificar que el email es válido
        if (!filter_var($usuario->email, FILTER_VALIDATE_EMAIL)) {
            Log::warning("Email inválido para usuario {$usuario->id}: {$usuario->email}");
            return;
        }

        // Verificar que el usuario quiere recibir emails (si tienes esta columna)
        if (isset($usuario->email_notifications) && !$usuario->email_notifications) {
            Log::info("Usuario {$usuario->id} tiene notificaciones desactivadas");
            return;
        }

        // Verificar que no hemos enviado demasiados emails recientemente
        $ultimosEmails = DB::table('sent_emails')
            ->where('user_id', $usuario->id)
            ->where('created_at', '>', now()->subHour())
            ->count();

        if ($ultimosEmails > 10) {
            Log::warning("Usuario {$usuario->id} ha recibido demasiados emails recientemente");
            return;
        }

        // Todo OK, enviar email
        try {
            Mail::to($usuario->email)->send(new EventCreatedMail($evento));

            // Registrar el envío (opcional)
            DB::table('sent_emails')->insert([
                'user_id' => $usuario->id,
                'email_type' => 'event_created',
                'created_at' => now()
            ]);
        } catch (\Exception $e) {
            Log::error("Error al enviar email: " . $e->getMessage());
        }
    }
}
