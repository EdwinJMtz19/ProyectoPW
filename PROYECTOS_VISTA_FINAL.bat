@echo off
echo ====================================
echo   PROYECTOS VISTA CORREGIDA
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ Vista de proyectos corregida
echo.
echo CAMBIOS APLICADOS:
echo - Corregido acceso a event que puede ser null
echo - Validaciones @if para evitar errores
echo - Vista funciona con equipos con o sin evento
echo - Modal simplificado y limpio
echo.
pause
