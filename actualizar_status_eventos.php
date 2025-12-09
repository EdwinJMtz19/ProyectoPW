<?php
// Script para actualizar el status de todos los eventos
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Event;
use Carbon\Carbon;

echo "Actualizando status de eventos...\n\n";

$now = Carbon::now()->startOfDay();
$eventos = Event::all();

foreach ($eventos as $evento) {
    $eventStart = Carbon::parse($evento->event_start_date)->startOfDay();
    $eventEnd = Carbon::parse($evento->event_end_date)->endOfDay();
    
    $oldStatus = $evento->status;
    
    if ($now->greaterThan($eventEnd)) {
        $newStatus = 'finished';
    } elseif ($now->between($eventStart, $eventEnd)) {
        $newStatus = 'in_progress';
    } else {
        $newStatus = 'upcoming';
    }
    
    if ($oldStatus !== $newStatus) {
        $evento->status = $newStatus;
        $evento->save();
        echo "✓ Evento '{$evento->title}': {$oldStatus} → {$newStatus}\n";
    } else {
        echo "- Evento '{$evento->title}': {$oldStatus} (sin cambios)\n";
    }
}

echo "\n✓ Actualización completada.\n";
