<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class UpdateEventStatuses extends Command
{
    protected $signature = 'events:update-statuses';
    protected $description = 'Actualiza el status de los eventos basándose en sus fechas';

    public function handle()
    {
        $now = Carbon::now();
        $updated = 0;

        $events = Event::where('is_published', true)->get();

        foreach ($events as $event) {
            $oldStatus = $event->status;
            $newStatus = $this->determineStatus($event, $now);

            if ($oldStatus !== $newStatus) {
                $event->status = $newStatus;
                $event->save();
                $updated++;
                $this->info("Evento '{$event->title}': {$oldStatus} → {$newStatus}");
            }
        }

        $this->info("Se actualizaron {$updated} eventos.");
        return 0;
    }

    private function determineStatus($event, $now)
    {
        // Si el evento ya terminó
        if ($now->greaterThan($event->event_end_date)) {
            return 'finished';
        }

        // Si el evento está en curso
        if ($now->between($event->event_start_date, $event->event_end_date)) {
            return 'in_progress';
        }

        // Si estamos en período de inscripciones (antes del inicio del evento)
        if ($now->lessThan($event->event_start_date)) {
            return 'upcoming';
        }

        return 'upcoming';
    }
}
