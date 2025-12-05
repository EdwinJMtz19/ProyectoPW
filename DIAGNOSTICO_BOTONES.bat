@echo off
echo ====================================
echo   DIAGNOSTICO BOTONES EQUIPOS
echo ====================================
echo.
echo Se creo vista de DEBUG temporal:
echo   evento-detalle-DEBUG.blade.php
echo.
echo SOLUCION RAPIDA:
echo.
echo 1. Abre tu archivo .env
echo 2. Cambia: APP_DEBUG=true
echo 3. Recarga la pagina del evento
echo 4. Veras mensajes DEBUG amarillos con:
echo    - ID de tu equipo
echo    - ID de cada equipo listado
echo    - Si hay match o no
echo.
echo Esto te mostrara EXACTAMENTE
echo que esta comparando el sistema.
echo.
echo ========================================
echo   PROBLEMA MAS PROBABLE:
echo ========================================
echo.
echo El usuario tiene varios equipos
echo pero $miEquipo no apunta al correcto.
echo.
echo Revisa en EventoController-^>show():
echo   - Linea 63: Busca registros del usuario
echo   - Linea 107: Asigna $miEquipo
echo.
echo El problema puede ser que:
echo   - $miEquipo no se esta cargando bien
echo   - Los IDs no coinciden (string vs int)
echo   - El usuario esta en varios equipos
echo.
echo ========================================
echo   SOLUCION DEFINITIVA:
echo ========================================
echo.
echo Elimina los equipos duplicados:
echo.
echo 1. Ve a /estudiante/proyectos
echo 2. Elimina proyectos extra
echo 3. O ejecuta SQL:
echo.
echo    DELETE FROM event_registrations
echo    WHERE team_id IN (
echo      SELECT team_id
echo      FROM event_registrations
echo      GROUP BY event_id, team_id
echo      HAVING COUNT(*) ^> 1
echo    );
echo.
echo 4. Limpia cache:
php artisan cache:clear
php artisan view:clear
echo.
echo ========================================
pause
