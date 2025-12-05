@echo off
echo ====================================
echo   CORREGIR PROYECTOS
echo ====================================
echo.
echo Limpiando cache...
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo.
echo ✓ Proyectos corregidos
echo.
echo CAMBIOS APLICADOS:
echo - Corregido ProyectoController para manejar teams sin evento
echo - event_id ahora es opcional al crear proyectos
echo - Permite proyectos para equipos con o sin evento asignado
echo.
pause
