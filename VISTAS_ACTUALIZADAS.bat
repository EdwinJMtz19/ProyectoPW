@echo off
echo ====================================
echo   VISTAS ACTUALIZADAS
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ Vistas actualizadas
echo.
echo CAMBIOS APLICADOS:
echo - Vista de proyectos con modal completo
echo - Modal permite seleccionar equipo y evento
echo - Vista de eventos lista para probar
echo - Dashboard accesible
echo.
echo PRUEBA ESTAS RUTAS:
echo - /estudiante/dashboard
echo - /estudiante/proyectos
echo - /estudiante/eventos
echo - /estudiante/equipos
echo.
pause
