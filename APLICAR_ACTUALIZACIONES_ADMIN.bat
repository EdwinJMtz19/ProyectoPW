@echo off
echo ============================================
echo APLICANDO ACTUALIZACIONES ADMIN
echo ============================================
echo.
echo Este script realizara los siguientes cambios:
echo - Crear tabla event_advisors para asignacion de asesores
echo - Actualizar funcionalidad de eventos (editar, asignar jueces/asesores)
echo - Agregar boton de eliminar en equipos
echo.
pause

echo.
echo Ejecutando migracion...
php artisan migrate --force

echo.
echo ============================================
echo MIGRACION COMPLETADA
echo ============================================
echo.
echo Las siguientes funcionalidades estan ahora disponibles:
echo.
echo EN VISTA DE EVENTOS (Admin):
echo   - Boton "Editar" ahora funcional con modal completo
echo   - Boton "Gestionar Jueces" para asignar/desasignar jueces
echo   - Boton "Gestionar Asesores" para asignar/desasignar asesores
echo.
echo EN VISTA DE EQUIPOS (Admin):
echo   - Boton de eliminar (icono basura) en cada equipo
echo.
echo IMPORTANTE:
echo - Los jueces y asesores asignados se reflejaran automaticamente en sus vistas
echo - No se modificaron las vistas de jueces o asesores como solicitaste
echo.
pause
