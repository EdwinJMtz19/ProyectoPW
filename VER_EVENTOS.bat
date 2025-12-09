@echo off
echo.
echo ========================================
echo   VERIFICANDO EVENTOS EN LA BD
echo ========================================
echo.

php -r "require 'vendor/autoload.php'; $app = require_once 'bootstrap/app.php'; $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class); $kernel->bootstrap(); use App\Models\Event; $eventos = Event::all(); echo 'Total eventos: ' . $eventos->count() . PHP_EOL . PHP_EOL; foreach($eventos as $e) { echo 'ID: ' . $e->id . PHP_EOL; echo 'Titulo: ' . $e->title . PHP_EOL; echo 'Status: ' . $e->status . PHP_EOL; echo 'Publicado: ' . ($e->is_published ? 'SI' : 'NO') . PHP_EOL; echo 'Fecha inicio: ' . $e->event_start_date . PHP_EOL; echo 'Fecha fin: ' . $e->event_end_date . PHP_EOL; echo '---' . PHP_EOL; }"

echo.
echo Presiona cualquier tecla para continuar...
pause > nul
