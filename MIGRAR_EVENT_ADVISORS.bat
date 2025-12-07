@echo off
echo Ejecutando migracion para crear tabla event_advisors...
php artisan migrate --force
echo.
echo Migracion completada!
pause
