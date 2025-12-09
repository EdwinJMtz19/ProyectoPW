@echo off
color 0A
cls
echo.
echo ================================================================
echo                  SOLUCION EVENTOS NO VISIBLES
echo ================================================================
echo.
echo Este script corregira el problema de eventos que no aparecen
echo en la vista de estudiantes.
echo.
echo Problema: Eventos antiguos tienen is_published = 0
echo Solucion: Actualizar is_published = 1 y recalcular status
echo.
echo ================================================================
echo.
pause

echo.
echo [PASO 1/3] Publicando todos los eventos...
echo ----------------------------------------------------------------
php -r "require 'vendor/autoload.php'; $app = require_once 'bootstrap/app.php'; $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class); $kernel->bootstrap(); use Illuminate\Support\Facades\DB; $result = DB::table('events')->update(['is_published' => true]); echo 'Eventos publicados: ' . $result . PHP_EOL;"

if %errorlevel% neq 0 (
    echo ERROR: No se pudieron publicar los eventos
    pause
    exit /b 1
)

echo.
echo [PASO 2/3] Actualizando status segun fechas...
echo ----------------------------------------------------------------
php artisan events:update-statuses

if %errorlevel% neq 0 (
    echo ERROR: No se pudo actualizar el status
    pause
    exit /b 1
)

echo.
echo [PASO 3/3] Limpiando cache de Laravel...
echo ----------------------------------------------------------------
php artisan cache:clear >nul 2>&1
php artisan config:clear >nul 2>&1
php artisan view:clear >nul 2>&1
echo Cache limpiado correctamente

echo.
echo ================================================================
echo                    RESUMEN DE EVENTOS
echo ================================================================
php -r "require 'vendor/autoload.php'; $app = require_once 'bootstrap/app.php'; $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class); $kernel->bootstrap(); use App\Models\Event; $total = Event::count(); $proximos = Event::where('status', 'upcoming')->count(); $activos = Event::where('status', 'in_progress')->count(); $finalizados = Event::where('status', 'finished')->count(); $publicados = Event::where('is_published', true)->count(); echo PHP_EOL; echo 'Total de eventos: ' . $total . PHP_EOL; echo 'Publicados: ' . $publicados . PHP_EOL; echo 'Proximos: ' . $proximos . PHP_EOL; echo 'Activos: ' . $activos . PHP_EOL; echo 'Finalizados: ' . $finalizados . PHP_EOL;"

echo.
echo ================================================================
echo                      PROCESO COMPLETADO
echo ================================================================
echo.
echo ✓ Todos los eventos han sido publicados y actualizados
echo ✓ Ahora deberias ver todos los eventos en la vista de estudiantes
echo.
echo Recarga la pagina web para ver los cambios
echo.
pause
