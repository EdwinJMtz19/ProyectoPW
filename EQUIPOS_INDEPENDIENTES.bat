@echo off
echo ====================================
echo   EQUIPOS INDEPENDIENTES
echo ====================================
echo.
echo Actualizando sistema de equipos...
echo.
echo Limpiando cache de rutas...
php artisan route:clear
echo.
echo Limpiando cache de configuracion...
php artisan config:clear
echo.
echo Limpiando cache general...
php artisan cache:clear
echo.
echo ✓ Sistema actualizado
echo.
echo CAMBIOS APLICADOS:
echo - Los equipos ahora se crean solo con nombre y descripcion
echo - Los equipos NO estan vinculados a un evento especifico
echo - Un mismo equipo puede participar en multiples eventos
echo - event_id se guarda como NULL al crear el equipo
echo.
pause
