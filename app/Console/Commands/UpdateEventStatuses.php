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
        $nowDate = $now->copy()->startOfDay();
        $eventStart = Carbon::parse($event->event_start_date)->startOfDay();
        $eventEnd = Carbon::parse($event->event_end_date)->endOfDay();
        
        // Si el evento ya terminó
        if ($nowDate->greaterThan($eventEnd)) {
            return 'finished';
        }

        // Si el evento está en curso
        if ($nowDate->between($eventStart, $eventEnd)) {
            return 'in_progress';
        }

        // Si estamos antes del inicio del evento
        if ($nowDate->lessThan($eventStart)) {
            return 'upcoming';
        }

        return 'upcoming';
    }
}
