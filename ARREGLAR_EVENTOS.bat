@echo off
echo.
echo ========================================
echo   PUBLICAR Y ACTUALIZAR EVENTOS
echo ========================================
echo.

php artisan tinker --execute="use App\Models\Event; use Carbon\Carbon; Event::query()->update(['is_published' => true]); echo 'Todos los eventos publicados'; echo PHP_EOL;"

echo.
echo Actualizando status...
echo.

php artisan events:update-statuses

echo.
echo ✓ Proceso completado
echo.
echo Presiona cualquier tecla para salir...
pause > nul
