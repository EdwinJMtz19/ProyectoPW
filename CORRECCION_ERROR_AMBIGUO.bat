@echo off
echo ====================================
echo   CORRECCION ERROR COLUMNA AMBIGUA
echo ====================================
echo.
echo ERROR ENCONTRADO:
echo   SQLSTATE[HY000]: General error: 1 ambiguous column name: team_id
echo.
echo CAUSA:
echo   El query tenia columna "team_id" que existe en:
echo   - event_registrations.team_id
echo   - join_requests.team_id
echo.
echo   Sin especificar la tabla, SQLite no sabia cual usar.
echo.
echo ========================================
echo   CORRECCION APLICADA:
echo ========================================
echo.
echo ANTES (linea 100):
echo   -^>where('team_id', $id)
echo   -^>where('status', 'pending')
echo.
echo AHORA (linea 100):
echo   -^>where('event_registrations.team_id', $id)
echo   -^>where('join_requests.team_id', $id)
echo   -^>where('join_requests.status', 'pending')
echo.
echo ========================================
echo   CAMBIOS EN EquipoController.php:
echo ========================================
echo.
echo Metodo show() - Linea 100:
echo   ✓ where('event_registrations.team_id', $id)
echo   ✓ Especifica tabla en eventos
echo.
echo Metodo show() - Linea 116:
echo   ✓ where('join_requests.team_id', $id)
echo   ✓ where('join_requests.status', 'pending')
echo   ✓ Especifica tabla en solicitudes
echo.
echo ========================================
echo   LIMPIANDO CACHE:
echo ========================================
echo.
php artisan view:clear
php artisan route:clear
php artisan cache:clear
php artisan config:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   VERIFICACION:
echo ========================================
echo.
echo 1. Ve a: http://localhost:8000/estudiante/equipos
echo 2. Click "Ver detalles" en cualquier equipo
echo 3. DEBE CARGAR SIN ERRORES
echo 4. Muestra:
echo    - Header con nombre del equipo
echo    - Lista de miembros
echo    - Eventos participados
echo    - Solicitudes (si eres lider)
echo    - Sidebar con estadisticas
echo.
echo ========================================
pause
