<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use App\Models\EventJudge;
use Illuminate\Support\Str;

class EventJudgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los jueces
        $judges = User::where('user_type', 'juez')->get();
        
        if ($judges->isEmpty()) {
            $this->command->warn('No hay jueces en la base de datos. Crea jueces primero.');
            return;
        }

        // Obtener todos los eventos
        $events = Event::all();
        
        if ($events->isEmpty()) {
            $this->command->warn('No hay eventos en la base de datos. Crea eventos primero.');
            return;
        }

        $this->command->info('Asignando jueces a eventos...');

        // Asignar cada juez a eventos aleatorios
        foreach ($judges as $judge) {
            // Cada juez será asignado a 2-4 eventos aleatorios
            $eventsToAssign = $events->random(min($events->count(), rand(2, 4)));
            
            foreach ($eventsToAssign as $event) {
                // Verificar si ya existe la asignación
                $exists = EventJudge::where('event_id', $event->id)
                    ->where('judge_id', $judge->id)
                    ->exists();
                
                if (!$exists) {
                    EventJudge::create([
                        'id' => (string) Str::uuid(),
                        'event_id' => $event->id,
                        'judge_id' => $judge->id,
                        'status' => 'active',
                        'assigned_at' => now()->subDays(rand(1, 30)),
                        'assigned_by' => User::where('user_type', 'admin')->first()?->id,
                        'notes' => 'Asignación automática del seeder',
                    ]);
                    
                    $this->command->info("✓ Juez {$judge->name} asignado al evento {$event->title}");
                }
            }
        }

        // También asignar múltiples jueces a cada evento para tener suficiente cobertura
        foreach ($events as $event) {
            $currentJudges = EventJudge::where('event_id', $event->id)->count();
            
            // Asegurar que cada evento tenga al menos 2 jueces
            if ($currentJudges < 2) {
                $judgesNeeded = 2 - $currentJudges;
                $availableJudges = $judges->whereNotIn('id', function($query) use ($event) {
                    $query->select('judge_id')
                        ->from('event_judges')
                        ->where('event_id', $event->id);
                })->take($judgesNeeded);
                
                foreach ($availableJudges as $judge) {
                    EventJudge::create([
                        'id' => (string) Str::uuid(),
                        'event_id' => $event->id,
                        'judge_id' => $judge->id,
                        'status' => 'active',
                        'assigned_at' => now()->subDays(rand(1, 30)),
                        'assigned_by' => User::where('user_type', 'admin')->first()?->id,
                        'notes' => 'Asignación automática para cobertura',
                    ]);
                    
                    $this->command->info("✓ Juez {$judge->name} asignado al evento {$event->title} (cobertura)");
                }
            }
        }

        $totalAssignments = EventJudge::count();
        $this->command->info("✓ Total de asignaciones creadas: {$totalAssignments}");
    }
}
