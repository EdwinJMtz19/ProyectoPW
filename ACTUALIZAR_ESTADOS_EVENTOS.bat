@echo off
echo ========================================
echo  ACTUALIZAR ESTADOS DE EVENTOS
echo ========================================
echo.
echo Ejecutando comando para actualizar estados...
echo.

php artisan events:update-statuses

echo.
echo ========================================
echo  COMPLETADO
echo ========================================
echo.
pause
