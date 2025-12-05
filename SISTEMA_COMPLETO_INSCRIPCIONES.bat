@echo off
echo ====================================
echo   SISTEMA COMPLETO DE INSCRIPCIONES
echo ====================================
echo.
echo Ejecutando migracion event_registrations...
php artisan migrate
echo.
echo Limpiando cache...
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo.
echo ✓ Sistema implementado
echo.
echo FUNCIONALIDADES:
echo - Crear proyecto desde vista PROYECTOS (manual)
echo - Inscribir equipo desde vista EVENTOS (automatico)
echo - Asignar asesor desde detalle de proyecto
echo - Un equipo puede participar en multiples eventos
echo - Validacion de equipos/eventos duplicados
echo - Tabla event_registrations para tracking
echo.
pause
