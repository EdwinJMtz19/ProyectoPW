@echo off
echo ====================================
echo   VALIDACION UN USUARIO = UN EQUIPO
echo   POR EVENTO
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ VALIDACIONES AGREGADAS
echo.
echo ========================================
echo   REGLA IMPLEMENTADA:
echo ========================================
echo.
echo Un usuario NO puede estar en dos equipos
echo del mismo evento.
echo.
echo Ejemplo INCORRECTO (ahora bloqueado):
echo   Usuario: Carlos
echo   Evento: Startup Weekend 2025
echo   ✗ Equipo A (Carlos = lider)
echo   ✗ Equipo B (Carlos = lider)
echo   ERROR: Carlos ya participa
echo.
echo ========================================
echo   VALIDACIONES AL INSCRIBIR:
echo ========================================
echo.
echo 1. Usuario es miembro del equipo
echo    ✓ Valida membresia
echo.
echo 2. Equipo no inscrito previamente
echo    ✓ Valida duplicados
echo.
echo 3. NINGUN miembro en otro equipo:
echo    ✓ Revisa TODOS los miembros
echo    ✓ Busca en event_registrations
echo    ✓ Excluye el equipo actual
echo    ✗ Si conflicto: mensaje con nombre
echo.
echo 4. Limite de equipos
echo    ✓ Verifica max_teams
echo.
echo ========================================
echo   VALIDACIONES AL CREAR EQUIPO:
echo ========================================
echo.
echo 1. Usuario no esta en otro equipo:
echo    ✓ Busca en event_registrations
echo    ✓ Valida antes de crear
echo    ✗ Si ya participa: mensaje con equipo
echo.
echo 2. Limite de equipos
echo    ✓ Verifica disponibilidad
echo.
echo ========================================
echo   MENSAJES DE ERROR:
echo ========================================
echo.
echo Si intenta inscribir equipo:
echo "No se puede inscribir: Carlos Mendez
echo  ya esta participando en este evento
echo  con el equipo 'equipo rojito'"
echo.
echo Si intenta crear equipo:
echo "Ya estas participando en este evento
echo  con el equipo 'equipo 1a'. No puedes
echo  estar en dos equipos del mismo evento."
echo.
echo ========================================
echo   SOLUCION PARA DATOS ACTUALES:
echo ========================================
echo.
echo Si ya tienes equipos duplicados:
echo.
echo 1. Ve a /estudiante/proyectos
echo 2. Elimina proyectos duplicados
echo 3. O ejecuta limpieza manual en BD:
echo.
echo    DELETE FROM event_registrations
echo    WHERE id NOT IN (
echo      SELECT MIN(id)
echo      FROM event_registrations
echo      GROUP BY event_id, user_id
echo    );
echo.
pause
