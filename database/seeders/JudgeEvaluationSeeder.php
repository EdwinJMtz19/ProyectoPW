<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Rubric;
use App\Models\RubricCriterion;
use App\Models\EventJudge;

class JudgeEvaluationSeeder extends Seeder
{
    /**
     * Seeder específico para crear datos de prueba de evaluaciones de jueces
     * Ejecutar con: php artisan db:seed --class=JudgeEvaluationSeeder
     */
    public function run(): void
    {
        echo "🎯 Creando datos de prueba para evaluaciones de jueces...\n\n";

        // 1. Crear jueces si no existen
        $jueces = $this->createJueces();
        echo "✅ Jueces creados: " . count($jueces) . "\n";

        // 2. Crear estudiantes si no existen
        $estudiantes = $this->createEstudiantes();
        echo "✅ Estudiantes creados: " . count($estudiantes) . "\n";

        // 3. Crear evento en progreso
        $evento = $this->createEvento();
        echo "✅ Evento creado: " . $evento->title . "\n";

        // 4. Crear rúbrica con criterios
        $rubrica = $this->createRubricaCompleta($evento);
        echo "✅ Rúbrica creada con " . $rubrica->criteria->count() . " criterios\n";

        // 5. Asignar jueces al evento
        $this->assignJudgesToEvent($evento, $jueces);
        echo "✅ Jueces asignados al evento\n";

        // 6. Crear equipos
        $equipos = $this->createTeams($evento, $estudiantes);
        echo "✅ Equipos creados: " . count($equipos) . "\n";

        // 7. Crear proyectos
        $proyectos = $this->createProjects($equipos, $evento);
        echo "✅ Proyectos creados: " . count($proyectos) . "\n";

        echo "\n🎉 ¡COMPLETADO!\n";
        echo "📧 Login juez: maria@juez.com / password123\n";
        echo "📊 Proyectos pendientes de evaluar: " . count($proyectos) . "\n";
        echo "🎯 Evento: " . $evento->title . "\n\n";
    }

    private function createJueces()
    {
        $jueces = [];
        
        // Verificar si ya existe el juez
        $juez1 = User::where('email', 'maria@juez.com')->first();
        if (!$juez1) {
            $juez1 = User::create([
                'id' => Str::uuid(),
                'email' => 'maria@juez.com',
                'password' => Hash::make('password123'),
                'name' => 'Dra. María García',
                'numero_control' => '30001234',
                'user_type' => 'juez',
                'is_active' => true,
            ]);
        }
        $jueces[] = $juez1;

        $juez2 = User::where('email', 'fernando@juez.com')->first();
        if (!$juez2) {
            $juez2 = User::create([
                'id' => Str::uuid(),
                'email' => 'fernando@juez.com',
                'password' => Hash::make('password123'),
                'name' => 'Dr. Fernando Jiménez',
                'numero_control' => '30001235',
                'user_type' => 'juez',
                'is_active' => true,
            ]);
        }
        $jueces[] = $juez2;

        return $jueces;
    }

    private function createEstudiantes()
    {
        $estudiantes = [];
        $nombres = ['Carlos', 'Ana', 'Luis', 'María', 'José', 'Sofía', 'Diego', 'Laura', 'Pedro', 'Carmen'];
        $apellidos = ['Méndez', 'García', 'Hernández', 'López', 'Ramírez'];
        
        for ($i = 0; $i < 10; $i++) {
            $nombre = $nombres[$i] . ' ' . $apellidos[$i % count($apellidos)];
            $email = strtolower(str_replace(' ', '', $nombres[$i])) . ($i + 1) . '@estudiante.com';
            
            // Verificar si ya existe
            $estudiante = User::where('email', $email)->first();
            if (!$estudiante) {
                $estudiante = User::create([
                    'id' => Str::uuid(),
                    'email' => $email,
                    'password' => Hash::make('password123'),
                    'name' => $nombre,
                    'numero_control' => '20' . sprintf('%06d', 211234 + $i),
                    'user_type' => 'estudiante',
                    'career' => 'Ing. en Sistemas',
                    'semester' => (($i % 4) + 5),
                    'is_active' => true,
                ]);
            }
            $estudiantes[] = $estudiante;
        }
        
        return $estudiantes;
    }

    private function createEvento()
    {
        // Verificar si ya existe
        $evento = Event::where('slug', 'hackathon-evaluaciones-2025')->first();
        if ($evento) {
            // Actualizar estado a in_progress
            $evento->update(['status' => 'in_progress']);
            return $evento;
        }

        return Event::create([
            'id' => Str::uuid(),
            'title' => 'Hackathon de Evaluaciones 2025',
            'slug' => 'hackathon-evaluaciones-2025',
            'description' => 'Hackathon para probar el sistema de evaluaciones. Desarrolla soluciones tecnológicas innovadoras en 48 horas intensivas.',
            'short_description' => 'Hackathon de 48 horas',
            'category' => 'Tecnología',
            'event_type' => 'hackathon',
            'status' => 'in_progress', // IMPORTANTE: En progreso para que se puedan evaluar
            'cover_image_url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80',
            'banner_image_url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80',
            'registration_start_date' => now()->subDays(30),
            'registration_end_date' => now()->subDays(5),
            'event_start_date' => now()->subDays(2),
            'event_end_date' => now()->addDays(5),
            'min_team_size' => 2,
            'max_team_size' => 4,
            'max_teams' => 20,
            'registered_teams_count' => 0,
            'location' => 'Auditorio Principal TecNM',
            'venue' => 'Campus Central',
            'is_online' => false,
            'organizer_name' => 'Departamento de Sistemas',
            'contact_email' => 'hackathon@tecnm.mx',
            'contact_phone' => '555-1234',
            'is_published' => true,
            'is_featured' => true,
        ]);
    }

    private function createRubricaCompleta($evento)
    {
        // Verificar si ya existe
        $rubrica = Rubric::where('event_id', $evento->id)->first();
        if ($rubrica) {
            return $rubrica->load('criteria');
        }

        $rubrica = Rubric::create([
            'id' => Str::uuid(),
            'event_id' => $evento->id,
            'name' => 'Rúbrica de Evaluación Hackathon 2025',
            'description' => 'Criterios de evaluación para proyectos del hackathon',
            'total_points' => 100,
            'is_active' => true,
        ]);

        // Crear criterios detallados
        $criterios = [
            [
                'name' => 'Innovación y Creatividad',
                'description' => 'Originalidad de la idea y enfoque creativo para resolver el problema',
                'max_points' => 20,
                'order_index' => 1,
            ],
            [
                'name' => 'Funcionalidad Técnica',
                'description' => 'Implementación técnica, código limpio y funcionalidades operativas',
                'max_points' => 25,
                'order_index' => 2,
            ],
            [
                'name' => 'Diseño e Interfaz',
                'description' => 'Experiencia de usuario, diseño visual y usabilidad',
                'max_points' => 15,
                'order_index' => 3,
            ],
            [
                'name' => 'Impacto y Viabilidad',
                'description' => 'Potencial de impacto real y viabilidad de implementación',
                'max_points' => 20,
                'order_index' => 4,
            ],
            [
                'name' => 'Presentación',
                'description' => 'Calidad de la presentación, claridad y comunicación del proyecto',
                'max_points' => 20,
                'order_index' => 5,
            ],
        ];

        foreach ($criterios as $criterio) {
            RubricCriterion::create(array_merge([
                'id' => Str::uuid(),
                'rubric_id' => $rubrica->id,
            ], $criterio));
        }

        return $rubrica->load('criteria');
    }

    private function assignJudgesToEvent($evento, $jueces)
    {
        foreach ($jueces as $juez) {
            // Verificar si ya está asignado
            $exists = EventJudge::where('event_id', $evento->id)
                                ->where('judge_id', $juez->id)
                                ->exists();
            
            if (!$exists) {
                EventJudge::create([
                    'id' => Str::uuid(),
                    'event_id' => $evento->id,
                    'judge_id' => $juez->id,
                    'status' => 'active',
                    'assigned_at' => now(),
                    'assigned_by' => null, // Asignado por el sistema
                    'notes' => 'Juez asignado para evaluación de proyectos',
                ]);
            }
        }
    }

    private function createTeams($evento, $estudiantes)
    {
        $nombresEquipos = [
            'Tech Innovators',
            'Code Warriors',
            'Digital Pioneers',
            'Smart Solutions',
            'Cyber Ninjas',
        ];

        $equipos = [];
        $estudianteIndex = 0;

        foreach ($nombresEquipos as $index => $nombreEquipo) {
            if ($estudianteIndex >= count($estudiantes) - 1) break;

            $teamId = Str::uuid();
            $leader = $estudiantes[$estudianteIndex];
            $member = $estudiantes[$estudianteIndex + 1];

            // Verificar si ya existe el equipo
            $team = Team::where('name', $nombreEquipo)
                        ->where('event_id', $evento->id)
                        ->first();
            
            if (!$team) {
                $team = Team::create([
                    'id' => $teamId,
                    'name' => $nombreEquipo,
                    'description' => 'Equipo participante en el hackathon',
                    'event_id' => $evento->id,
                    'leader_id' => $leader->id,
                    'status' => 'active',
                    'invitation_code' => strtoupper(substr(md5($teamId . time()), 0, 6)),
                    'members_count' => 2,
                ]);

                // Agregar miembros del equipo
                DB::table('team_members')->insert([
                    [
                        'id' => Str::uuid(),
                        'team_id' => $team->id,
                        'user_id' => $leader->id,
                        'role' => 'leader',
                        'joined_at' => now(),
                    ],
                    [
                        'id' => Str::uuid(),
                        'team_id' => $team->id,
                        'user_id' => $member->id,
                        'role' => 'member',
                        'joined_at' => now(),
                    ],
                ]);

                $evento->increment('registered_teams_count');
            }

            $equipos[] = $team;
            $estudianteIndex += 2;
        }

        return $equipos;
    }

    private function createProjects($equipos, $evento)
    {
        $proyectosData = [
            [
                'title' => 'EcoTrack - Monitor Ambiental',
                'description' => 'Sistema IoT para monitoreo de calidad del aire en tiempo real con alertas inteligentes y dashboard interactivo.',
                'repository_url' => 'https://github.com/ecotrack/ecotrack-app',
                'demo_url' => 'https://ecotrack.demo.com',
            ],
            [
                'title' => 'SmartHealth - Telemedicina',
                'description' => 'Plataforma de telemedicina con IA para diagnósticos preliminares y consultas virtuales.',
                'repository_url' => 'https://github.com/smarthealth/app',
                'demo_url' => 'https://smarthealth.demo.com',
            ],
            [
                'title' => 'EduConnect - Red Social Educativa',
                'description' => 'Red social educativa con gamificación para estudiantes y profesores.',
                'repository_url' => 'https://github.com/educonnect/platform',
                'demo_url' => 'https://educonnect.demo.com',
            ],
            [
                'title' => 'AgriBot - Agricultura Inteligente',
                'description' => 'Robot autónomo con sensores para agricultura de precisión y riego inteligente.',
                'repository_url' => 'https://github.com/agribot/control',
                'demo_url' => null,
            ],
            [
                'title' => 'CleanEnergy - Gestión Solar',
                'description' => 'Sistema de gestión y optimización de paneles solares con predicción de energía.',
                'repository_url' => 'https://github.com/cleanenergy/dashboard',
                'demo_url' => 'https://cleanenergy.demo.com',
            ],
        ];

        $proyectos = [];

        foreach ($equipos as $index => $equipo) {
            if ($index >= count($proyectosData)) break;

            $proyectoData = $proyectosData[$index];

            // Verificar si ya existe
            $proyecto = Project::where('team_id', $equipo->id)->first();
            if (!$proyecto) {
                $proyecto = Project::create([
                    'id' => Str::uuid(),
                    'team_id' => $equipo->id,
                    'event_id' => $evento->id,
                    'title' => $proyectoData['title'],
                    'description' => $proyectoData['description'],
                    'repository_url' => $proyectoData['repository_url'],
                    'demo_url' => $proyectoData['demo_url'],
                    'status' => 'submitted', // IMPORTANTE: Submitted para que aparezca en evaluaciones
                    'submitted_at' => now()->subHours(rand(1, 24)),
                    'final_score' => null,
                    'rank' => null,
                ]);
            }

            $proyectos[] = $proyecto;
        }

        return $proyectos;
    }
}
