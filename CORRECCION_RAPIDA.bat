@echo off
echo ====================================
echo   CORRECCION RAPIDA - EQUIPOS
echo ====================================
echo.
echo Ejecutando migracion...
php artisan migrate --force
echo.
echo Limpiando cache completo...
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo.
echo ✓ Listo para probar
echo.
echo CAMBIOS APLICADOS:
echo - EquipoController actualizado
echo - Eventos participados agregado
echo - Validaciones mejoradas
echo.
echo Ahora prueba entrar a:
echo - Equipos
echo - Proyectos
echo - Eventos
echo.
pause
