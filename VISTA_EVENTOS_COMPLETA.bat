@echo off
echo ====================================
echo   VISTA DE EVENTOS COMPLETA
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ VISTA DE EVENTOS FUNCIONANDO
echo.
echo ========================================
echo   FUNCIONALIDADES IMPLEMENTADAS:
echo ========================================
echo.
echo 1. DOS MODALES EN EVENTO-DETALLE:
echo    ✓ Modal "Inscribir mi equipo" (equipos existentes)
echo      - Selecciona equipo
echo      - Nombre proyecto
echo      - Descripcion proyecto
echo      - Crea proyecto e inscribe automaticamente
echo.
echo    ✓ Modal "Crear nuevo equipo"
echo      - Nombre equipo
echo      - Descripcion
echo      - Crea equipo independiente (sin event_id)
echo      - Luego se puede inscribir
echo.
echo 2. BOTONES DINAMICOS:
echo    - Si tiene equipo inscrito: "Ver mi equipo"
echo    - Si tiene equipos sin inscribir: 2 botones
echo      * "Inscribir mi equipo" (principal)
echo      * "Crear nuevo equipo" (secundario)
echo    - Si no tiene equipos: "Crear equipo"
echo.
echo 3. EQUIPOS INSCRITOS:
echo    - Lista de equipos en el evento
echo    - Botones segun estado:
echo      * "Tu equipo" (si es el tuyo)
echo      * "Solicitar unirme" (disponible)
echo      * "Solicitud enviada" (pendiente)
echo      * "Equipo lleno" (completo)
echo.
echo 4. SISTEMA DE INSCRIPCION:
echo    - Equipos independientes (event_id = null)
echo    - Inscripcion via event_registrations
echo    - Un equipo = multiples eventos
echo    - Proyecto creado al inscribir
echo.
echo ========================================
echo   FLUJO COMPLETO:
echo ========================================
echo.
echo OPCION A - INSCRIBIR EQUIPO EXISTENTE:
echo   1. Usuario ve evento
echo   2. Click "Inscribir mi equipo"
echo   3. Modal: selecciona equipo + proyecto
echo   4. Se crea proyecto e inscribe equipo
echo.
echo OPCION B - CREAR NUEVO EQUIPO:
echo   1. Usuario ve evento
echo   2. Click "Crear nuevo equipo"
echo   3. Modal: nombre + descripcion
echo   4. Se crea equipo independiente
echo   5. Recarga pagina
echo   6. Ahora puede inscribirlo (Opcion A)
echo.
echo ========================================
pause
