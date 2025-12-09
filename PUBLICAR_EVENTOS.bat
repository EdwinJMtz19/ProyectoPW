@echo off
echo.
echo ========================================
echo   PUBLICANDO TODOS LOS EVENTOS
echo ========================================
echo.

php -r "require 'vendor/autoload.php'; $app = require_once 'bootstrap/app.php'; $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class); $kernel->bootstrap(); use App\Models\Event; use Carbon\Carbon; $now = Carbon::now()->startOfDay(); $eventos = Event::all(); $actualizados = 0; foreach($eventos as $evento) { $cambios = false; if (!$evento->is_published) { $evento->is_published = true; $cambios = true; echo 'Publicando: ' . $evento->title . PHP_EOL; } $eventStart = Carbon::parse($evento->event_start_date)->startOfDay(); $eventEnd = Carbon::parse($evento->event_end_date)->endOfDay(); $oldStatus = $evento->status; if ($now->greaterThan($eventEnd)) { $newStatus = 'finished'; } elseif ($now->between($eventStart, $eventEnd)) { $newStatus = 'in_progress'; } else { $newStatus = 'upcoming'; } if ($oldStatus !== $newStatus) { $evento->status = $newStatus; $cambios = true; echo 'Actualizando status de ' . $evento->title . ': ' . $oldStatus . ' -> ' . $newStatus . PHP_EOL; } if ($cambios) { $evento->save(); $actualizados++; } } echo PHP_EOL . 'Total eventos actualizados: ' . $actualizados . PHP_EOL;"

echo.
echo Presiona cualquier tecla para continuar...
pause > nul
