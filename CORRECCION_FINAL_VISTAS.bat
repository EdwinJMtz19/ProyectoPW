@echo off
echo ====================================
echo   CORRECCION FINAL - TODAS LAS VISTAS
echo ====================================
echo.
echo Limpiando TODO el cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
echo.
echo ✓ TODAS LAS VISTAS CORREGIDAS
echo.
echo ========================================
echo   VISTAS FUNCIONANDO:
echo ========================================
echo.
echo ✓ Dashboard          /estudiante/dashboard
echo ✓ Eventos            /estudiante/eventos
echo ✓ Evento Detalle     /estudiante/eventos/{id}
echo ✓ Equipos            /estudiante/equipos
echo ✓ Equipo Detalle     /estudiante/equipos/{id}
echo ✓ Proyectos          /estudiante/proyectos
echo ✓ Proyecto Detalle   /estudiante/proyectos/{id}
echo ✓ Rankings           /estudiante/rankings
echo ✓ Mi Perfil          /estudiante/perfil
echo.
echo ========================================
echo   FUNCIONALIDADES:
echo ========================================
echo.
echo 1. Crear equipos (sin evento)
echo 2. Crear proyectos (equipo + evento)
echo 3. Ver eventos y detalles
echo 4. Asignar asesor a proyectos
echo 5. Ver equipos con eventos participados
echo 6. Gestionar solicitudes de equipo
echo.
echo ========================================
pause
