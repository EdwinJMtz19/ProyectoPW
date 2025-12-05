@echo off
echo ====================================
echo   CORREGIR EVENT_ID NULLABLE
echo ====================================
echo.
echo Ejecutando migracion...
php artisan migrate
echo.
echo Limpiando cache...
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ Ahora event_id es nullable en teams
echo ✓ Los equipos pueden crearse sin evento
echo.
pause
