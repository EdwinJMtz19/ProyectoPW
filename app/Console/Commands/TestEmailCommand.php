<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\WelcomeMail;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email? : El email al que enviar el correo de prueba}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar un correo de prueba para verificar la configuración de Brevo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        // Si no se proporciona email, preguntar
        if (!$email) {
            $email = $this->ask('¿A qué correo deseas enviar el email de prueba?');
        }

        // Validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('El email proporcionado no es válido');
            return 1;
        }

        $this->info('Preparando email de prueba...');

        // Crear un usuario temporal para la prueba
        $testUser = new User([
            'name' => 'Usuario de Prueba',
            'email' => $email,
            'user_type' => 'estudiante'
        ]);

        try {
            $this->info('Enviando email a: ' . $email);

            Mail::to($email)->send(new WelcomeMail($testUser));

            $this->newLine();
            $this->info('✅ Email enviado exitosamente!');
            $this->info('Revisa la bandeja de entrada de: ' . $email);
            $this->info('(También revisa la carpeta de spam si no lo ves)');

            return 0;

        } catch (\Exception $e) {
            $this->newLine();
            $this->error('❌ Error al enviar el email:');
            $this->error($e->getMessage());
            $this->newLine();
            $this->warn('Verifica:');
            $this->warn('1. Las credenciales en el archivo .env');
            $this->warn('2. Que la configuración esté actualizada: php artisan config:clear');
            $this->warn('3. Los logs en storage/logs/laravel.log');

            return 1;
        }
    }
}
