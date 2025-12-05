@echo off
echo ====================================
echo   DEBUG EVENTOS DISPONIBLES
echo ====================================
echo.
echo Limpiando cache...
php artisan cache:clear
php artisan view:clear
echo.
echo ========================================
echo   MENSAJE INFORMATIVO:
echo ========================================
echo.
echo Si el select de eventos aparece vacio:
echo.
echo RAZON: No hay eventos que cumplan:
echo   1. is_published = true
echo   2. event_end_date >= HOY
echo   3. registration_end_date >= HOY
echo      O event_start_date >= HOY - 7 dias
echo.
echo SOLUCION TEMPORAL:
echo.
echo Ve a la tabla "events" y asegurate que:
echo   - Al menos 1 evento tenga is_published = 1
echo   - La fecha event_end_date sea futura
echo   - La fecha registration_end_date sea futura
echo.
echo O ejecuta: EVENT_JUEZ_SEEDER.bat
echo.
echo ========================================
echo.
echo Ahora la vista muestra:
echo   - Mensaje si no hay eventos
echo   - Select deshabilitado si no hay eventos
echo   - Boton deshabilitado si no hay eventos
echo   - Contador en consola (F12)
echo.
pause
