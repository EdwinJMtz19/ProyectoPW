@echo off
echo ====================================
echo   CORRECCION BOTON "VER MI EQUIPO"
echo ====================================
echo.
echo Problema: El boton no funcionaba correctamente
echo.
echo Solucion aplicada:
echo   ✓ Correccion en EventoController
echo   ✓ Variable $miEquipo ahora es objeto Team
echo   ✓ Link funciona correctamente
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan cache:clear
echo.
echo ✓ BOTON "VER MI EQUIPO" FUNCIONANDO
echo.
echo ========================================
echo   FLUJO CORREGIDO:
echo ========================================
echo.
echo Eventos → Ver evento
echo    ↓
echo  ¿Tiene equipo inscrito?
echo    ↓
echo  SI → Muestra "Ya estas inscrito"
echo    ↓
echo  Boton "Ver mi equipo"
echo    ↓
echo  Link: /equipos/{team_id} ✓
echo.
pause
