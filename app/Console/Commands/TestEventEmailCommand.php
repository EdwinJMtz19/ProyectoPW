<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Event;
use App\Mail\EventCreatedMail;

class TestEventEmailCommand extends Command
{
    protected $signature = 'email:test-event {email? : Email al que enviar}';
    protected $description = 'Probar envío de email de nuevo evento';

    public function handle()
    {
        $email = $this->argument('email') ?: $this->ask('¿A qué email enviar la prueba?');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Email inválido');
            return 1;
        }

        // Buscar un evento o crear uno temporal
        $evento = Event::first();

        if (!$evento) {
            $this->warn('No hay eventos en la BD, creando uno temporal para prueba...');
            $evento = new Event([
                'title' => 'Evento de Prueba',
                'description' => 'Este es un evento de prueba para verificar el envío de emails',
                'category' => 'Tecnología',
                'event_start_date' => now()->addDays(30),
                'event_end_date' => now()->addDays(31),
                'registration_start_date' => now(),
                'registration_end_date' => now()->addDays(20),
                'min_team_size' => 3,
                'max_team_size' => 5,
                'is_online' => true,
                'status' => 'upcoming'
            ]);
            // No lo guardamos, solo lo usamos para el email
        }

        $this->info('Enviando email de prueba...');
        $this->line('Evento: ' . $evento->title);
        $this->line('Destinatario: ' . $email);

        try {
            Mail::to($email)->send(new EventCreatedMail($evento));

            $this->newLine();
            $this->info('✅ Email enviado exitosamente!');
            $this->info('Revisa tu bandeja de entrada: ' . $email);

            return 0;

        } catch (\Exception $e) {
            $this->newLine();
            $this->error('❌ Error al enviar email:');
            $this->error($e->getMessage());
            $this->newLine();
            $this->line('Detalles técnicos:');
            $this->line($e->getTraceAsString());

            return 1;
        }
    }
}
