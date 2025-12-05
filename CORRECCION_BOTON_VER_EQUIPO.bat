@echo off
echo ====================================
echo   CORRECCION BOTON "VER MI EQUIPO"
echo ====================================
echo.
echo SOLUCION:
echo La ruta esta bien definida:
echo   Route::get('/equipos/{id}', ...)
echo   -^> /estudiante/equipos/{id}
echo.
echo El problema es que $miEquipo puede ser null
echo o tener un ID invalido.
echo.
echo ========================================
echo   APLICANDO CORRECCIONES:
echo ========================================
echo.
echo 1. Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan cache:clear
php artisan config:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   DIAGNOSTICO:
echo ========================================
echo.
echo Abre la vista del evento y mira el sidebar.
echo.
echo SI DICE "Ya estas inscrito" pero el boton
echo "Ver mi equipo" no funciona:
echo.
echo 1. Abre DevTools (F12)
echo 2. Click derecho en el boton "Ver mi equipo"
echo 3. "Inspeccionar elemento"
echo 4. Ve el href generado
echo.
echo DEBE SER:
echo   href="/estudiante/equipos/[UUID-VALIDO]"
echo.
echo SI ES:
echo   href="/estudiante/equipos/"  (vacio)
echo   PROBLEMA: $miEquipo-^>id es null
echo.
echo   href="/estudiante/equipos/null"
echo   PROBLEMA: $miEquipo es null
echo.
echo ========================================
echo   SOLUCION SQL TEMPORAL:
echo ========================================
echo.
echo Si $miEquipo es null, verifica en BD:
echo.
echo SELECT 
echo   t.id, 
echo   t.name,
echo   er.event_id,
echo   e.title
echo FROM teams t
echo JOIN event_registrations er ON t.id = er.team_id
echo JOIN events e ON er.event_id = e.id
echo WHERE t.id IN (
echo   SELECT team_id 
echo   FROM team_members 
echo   WHERE user_id = (
echo     SELECT id 
echo     FROM users 
echo     WHERE email = 'carlos1@estudiante.com'
echo   )
echo );
echo.
echo Esto te mostrara los equipos del usuario.
echo.
echo ========================================
echo   SI TIENES EQUIPOS DUPLICADOS:
echo ========================================
echo.
echo El sistema solo puede mostrar UN equipo.
echo Si tienes 2 equipos en el mismo evento:
echo.
echo 1. Ve a /estudiante/proyectos
echo 2. Elimina el proyecto que NO quieras
echo 3. Esto eliminara el registro de event_registrations
echo 4. Recarga la pagina del evento
echo.
echo O ejecuta SQL:
echo.
echo DELETE FROM event_registrations
echo WHERE team_id = 'ID_DEL_EQUIPO_A_ELIMINAR';
echo.
echo ========================================
echo   VERIFICACION MANUAL:
echo ========================================
echo.
echo 1. Copia el ID de tu equipo desde la BD
echo 2. Pega en el navegador:
echo    http://localhost:8000/estudiante/equipos/[ID]
echo 3. Si funciona = problema en la vista
echo 4. Si no funciona = problema en el controlador
echo.
pause
