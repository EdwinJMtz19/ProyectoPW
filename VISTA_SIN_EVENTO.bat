@echo off
echo ====================================
echo   VISTA EQUIPOS SIN EVENTO
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ Vista actualizada
echo.
echo CAMBIOS APLICADOS:
echo - Eliminada toda referencia a evento en vista de detalle
echo - Sidebar muestra info del equipo, no del evento
echo - Ya no se muestra nombre del evento en tarjetas
echo - Vista funciona para equipos con o sin evento asignado
echo.
pause
