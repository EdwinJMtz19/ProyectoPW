@echo off
chcp 65001 >nul
color 0A
cls

type DIAGRAMA_VISUAL.txt

echo.
echo.
echo ═══════════════════════════════════════════════════════════════════
echo  🚀 ¿QUÉ QUIERES HACER?
echo ═══════════════════════════════════════════════════════════════════
echo.
echo  [1] Verificar que todo está instalado correctamente
echo  [2] Leer instrucciones completas
echo  [3] Iniciar servidor Laravel (modo completo con guía)
echo  [4] Iniciar servidor Laravel (modo rápido)
echo  [5] Ver documentación detallada
echo  [6] Salir
echo.
set /p opcion="Elige una opción (1-6): "

if "%opcion%"=="1" (
    cls
    call VERIFICAR_INSTALACION.bat
    goto menu
)

if "%opcion%"=="2" (
    cls
    type RESUMEN_FINAL.md
    echo.
    pause
    goto menu
)

if "%opcion%"=="3" (
    cls
    call INICIAR_TODO.bat
    goto fin
)

if "%opcion%"=="4" (
    cls
    call INICIAR_EVENTOS_3_TABS.bat
    goto fin
)

if "%opcion%"=="5" (
    cls
    type EVENTOS_3_TABS_README.md
    echo.
    pause
    goto menu
)

if "%opcion%"=="6" (
    goto fin
)

:menu
cls
goto inicio

:fin
echo.
echo ¡Hasta pronto!
timeout /t 2 >nul
exit
