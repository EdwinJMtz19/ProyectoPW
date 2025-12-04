<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Evaluation;
use App\Models\EvaluationScore;

class ResetEvaluationsSeeder extends Seeder
{
    /**
     * Elimina todas las evaluaciones y deja los proyectos listos para evaluar
     * Ejecutar con: php artisan db:seed --class=ResetEvaluationsSeeder
     */
    public function run(): void
    {
        echo "🧹 Limpiando evaluaciones existentes...\n\n";

        // Contar registros antes de eliminar
        $evaluationScoresCount = EvaluationScore::count();
        $evaluationsCount = Evaluation::count();
        $projectsWithScore = Project::whereNotNull('final_score')->count();

        echo "📊 Estado actual:\n";
        echo "   - Calificaciones por criterio: {$evaluationScoresCount}\n";
        echo "   - Evaluaciones completas: {$evaluationsCount}\n";
        echo "   - Proyectos con calificación: {$projectsWithScore}\n\n";

        // Eliminar todas las calificaciones por criterio
        DB::table('evaluation_scores')->delete();
        echo "✅ Calificaciones por criterio eliminadas\n";

        // Eliminar todas las evaluaciones
        DB::table('evaluations')->delete();
        echo "✅ Evaluaciones eliminadas\n";

        // Resetear el estado de todos los proyectos
        $updatedProjects = Project::query()->update([
            'status' => 'submitted',
            'final_score' => null,
            'rank' => null,
            'evaluated_at' => null,
        ]);
        echo "✅ {$updatedProjects} proyectos reseteados a estado 'submitted'\n";

        // Mostrar proyectos disponibles para evaluar
        $submittedProjects = Project::where('status', 'submitted')
            ->with('team', 'event')
            ->get();

        echo "\n📋 Proyectos listos para evaluar ({$submittedProjects->count()}):\n";
        foreach ($submittedProjects as $project) {
            echo "   • {$project->title} (Equipo: {$project->team->name})\n";
        }

        echo "\n🎯 ¡Listo! Ahora puedes evaluar los proyectos desde el panel de juez.\n";
        echo "📧 Login de prueba: maria@juez.com / password123\n\n";
    }
}
