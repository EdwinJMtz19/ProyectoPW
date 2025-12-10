@echo off
echo ========================================
echo EJECUTANDO MIGRACIONES PENDIENTES
echo ========================================
echo.

REM Ejecutar migraciones
php artisan migrate

echo.
echo ========================================
echo MIGRACIONES COMPLETADAS
echo ========================================
echo.
pause
