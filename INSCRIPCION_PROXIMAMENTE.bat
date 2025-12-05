@echo off
echo ====================================
echo   INSCRIPCION A EVENTOS PROXIMAMENTE
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ FILTRO ACTUALIZADO
echo.
echo ========================================
echo   AHORA MUESTRA EVENTOS CON:
echo ========================================
echo.
echo 1. ESTADO = "upcoming" (Proximamente)
echo    O
echo    ESTADO = "open" (En curso)
echo.
echo 2. is_published = true (Publicados)
echo.
echo 3. event_end_date >= HOY (No terminados)
echo    O event_end_date = NULL
echo.
echo ========================================
echo   ANTES vs AHORA:
echo ========================================
echo.
echo ANTES:
echo   - Solo eventos con registro abierto
echo   - Muy restrictivo con fechas
echo   ✗ NO mostraba "proximamente"
echo.
echo AHORA:
echo   ✓ Eventos "proximamente" (upcoming)
echo   ✓ Eventos "abiertos" (open)
echo   ✓ No terminados
echo   ✗ NO eventos "finished"
echo.
echo ========================================
echo   VALIDACIONES AL CREAR:
echo ========================================
echo.
echo 1. ✓ Usuario es miembro del equipo
echo 2. ✓ Evento publicado
echo 3. ✓ Status = upcoming u open
echo 4. ✓ Evento no terminado
echo 5. ✓ Equipo no inscrito previamente
echo 6. ✓ Evento no lleno
echo 7. ✓ Sin conflictos de miembros
echo.
echo ========================================
echo   EJEMPLO:
echo ========================================
echo.
echo Evento: IoT Challenge 2025
echo Status: upcoming
echo Fecha inicio: 15 Ene 2025
echo Fecha fin: 20 Ene 2025
echo.
echo ✓ APARECE en el select
echo ✓ PUEDES inscribirte
echo.
echo ========================================
pause
