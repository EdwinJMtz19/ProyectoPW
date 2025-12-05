@echo off
echo ====================================
echo   CORRECCION BOTONES EQUIPOS
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan cache:clear
echo.
echo ✓ LOGICA DE BOTONES CORREGIDA
echo.
echo ========================================
echo   REGLAS DE VISUALIZACION:
echo ========================================
echo.
echo SI ES TU EQUIPO:
echo   → Muestra: "Tu equipo" (verde)
echo   → NO muestra: "Solicitar unirme"
echo.
echo SI YA TIENES EQUIPO EN EL EVENTO:
echo   → Otros equipos muestran: "-" (gris)
echo   → NO muestras: "Solicitar unirme"
echo.
echo SI NO TIENES EQUIPO:
echo   → Y equipo tiene espacio: "Solicitar unirme"
echo   → Y equipo lleno: "Equipo lleno"
echo   → Y ya enviaste solicitud: "Solicitud enviada"
echo.
echo ========================================
echo   DETECCION DE "TU EQUIPO":
echo ========================================
echo.
echo La vista compara:
echo   if ($miEquipo and $miEquipo-^>id === $equipo-^>id)
echo.
echo $miEquipo se obtiene de:
echo   - event_registrations
echo   - team_members
echo   - Para el evento actual
echo.
echo ========================================
echo   SIDEBAR:
echo ========================================
echo.
echo SI TIENES EQUIPO INSCRITO:
echo   ✓ Ya estas inscrito
echo   ✓ Equipo: {nombre}
echo   [Ver mi equipo]
echo.
echo SI NO TIENES EQUIPO:
echo   [Inscribir mi equipo] (si tienes equipos)
echo   [Crear nuevo equipo]
echo.
echo ========================================
pause
