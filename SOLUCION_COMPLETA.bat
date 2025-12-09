@echo off
cls
echo.
echo ============================================================
echo          SOLUCION COMPLETA - MOSTRAR TODOS LOS EVENTOS
echo ============================================================
echo.
echo Este script hara lo siguiente:
echo 1. Publicar todos los eventos (is_published = 1)
echo 2. Actualizar el status de cada evento segun sus fechas
echo 3. Limpiar cache de Laravel
echo.
echo ============================================================
echo.
pause

echo.
echo [1/4] Publicando todos los eventos...
php artisan tinker --execute="DB::table('events')->update(['is_published' => true]); echo 'OK';"

echo.
echo [2/4] Actualizando status de eventos...
php artisan events:update-statuses

echo.
echo [3/4] Limpiando cache...
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo.
echo [4/4] Verificando eventos...
echo.
php artisan tinker --execute="use App\Models\Event; \$eventos = Event::all(); echo 'Total eventos: ' . \$eventos->count() . PHP_EOL; \$proximos = \$eventos->where('status', 'upcoming')->count(); \$activos = \$eventos->where('status', 'in_progress')->count(); \$finalizados = \$eventos->where('status', 'finished')->count(); echo 'Proximos: ' . \$proximos . PHP_EOL; echo 'Activos: ' . \$activos . PHP_EOL; echo 'Finalizados: ' . \$finalizados . PHP_EOL;"

echo.
echo ============================================================
echo                     PROCESO COMPLETADO
echo ============================================================
echo.
echo Ahora actualiza la pagina web para ver todos los eventos.
echo.
pause
