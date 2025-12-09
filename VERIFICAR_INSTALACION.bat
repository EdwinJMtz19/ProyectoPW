@echo off
chcp 65001 >nul
color 0B
echo.
echo ╔════════════════════════════════════════════════════════════════╗
echo ║                                                                ║
echo ║           🔍 VERIFICACIÓN DE INSTALACIÓN                      ║
echo ║                                                                ║
echo ╚════════════════════════════════════════════════════════════════╝
echo.

echo Verificando archivos modificados...
echo.

set "errors=0"

REM Verificar EventoController
if exist "app\Http\Controllers\Estudiante\EventoController.php" (
    echo ✅ EventoController.php encontrado
) else (
    echo ❌ ERROR: EventoController.php no encontrado
    set /a errors+=1
)

REM Verificar vista principal
if exist "resources\views\estudiante\eventos.blade.php" (
    echo ✅ eventos.blade.php encontrado
) else (
    echo ❌ ERROR: eventos.blade.php no encontrado
    set /a errors+=1
)

REM Verificar partial
if exist "resources\views\estudiante\partials\evento-card.blade.php" (
    echo ✅ evento-card.blade.php encontrado
) else (
    echo ❌ ERROR: evento-card.blade.php no encontrado
    set /a errors+=1
)

REM Verificar SQL
if exist "CREAR_EVENTOS_EJEMPLO.sql" (
    echo ✅ CREAR_EVENTOS_EJEMPLO.sql encontrado
) else (
    echo ⚠️  ADVERTENCIA: CREAR_EVENTOS_EJEMPLO.sql no encontrado
)

REM Verificar README
if exist "EVENTOS_3_TABS_README.md" (
    echo ✅ EVENTOS_3_TABS_README.md encontrado
) else (
    echo ⚠️  ADVERTENCIA: EVENTOS_3_TABS_README.md no encontrado
)

REM Verificar scripts
if exist "INICIAR_TODO.bat" (
    echo ✅ INICIAR_TODO.bat encontrado
) else (
    echo ⚠️  ADVERTENCIA: INICIAR_TODO.bat no encontrado
)

echo.
echo ════════════════════════════════════════════════════════════════
echo  VERIFICACIÓN DE CONTENIDO
echo ════════════════════════════════════════════════════════════════
echo.

REM Verificar que EventoController tiene los 3 métodos
findstr /C:"eventosProximos" "app\Http\Controllers\Estudiante\EventoController.php" >nul
if %errorlevel% equ 0 (
    echo ✅ EventoController tiene método para eventos próximos
) else (
    echo ❌ ERROR: EventoController no tiene método para eventos próximos
    set /a errors+=1
)

findstr /C:"eventosActivos" "app\Http\Controllers\Estudiante\EventoController.php" >nul
if %errorlevel% equ 0 (
    echo ✅ EventoController tiene método para eventos activos
) else (
    echo ❌ ERROR: EventoController no tiene método para eventos activos
    set /a errors+=1
)

findstr /C:"eventosTerminados" "app\Http\Controllers\Estudiante\EventoController.php" >nul
if %errorlevel% equ 0 (
    echo ✅ EventoController tiene método para eventos terminados
) else (
    echo ❌ ERROR: EventoController no tiene método para eventos terminados
    set /a errors+=1
)

REM Verificar que la vista tiene los tabs
findstr /C:"tab-proximos" "resources\views\estudiante\eventos.blade.php" >nul
if %errorlevel% equ 0 (
    echo ✅ Vista tiene tab de próximos
) else (
    echo ❌ ERROR: Vista no tiene tab de próximos
    set /a errors+=1
)

findstr /C:"tab-activos" "resources\views\estudiante\eventos.blade.php" >nul
if %errorlevel% equ 0 (
    echo ✅ Vista tiene tab de activos
) else (
    echo ❌ ERROR: Vista no tiene tab de activos
    set /a errors+=1
)

findstr /C:"tab-terminados" "resources\views\estudiante\eventos.blade.php" >nul
if %errorlevel% equ 0 (
    echo ✅ Vista tiene tab de terminados
) else (
    echo ❌ ERROR: Vista no tiene tab de terminados
    set /a errors+=1
)

echo.
echo ════════════════════════════════════════════════════════════════
echo  RESULTADO FINAL
echo ════════════════════════════════════════════════════════════════
echo.

if %errors% equ 0 (
    echo  ✅✅✅ TODO CORRECTO ✅✅✅
    echo.
    echo  🎉 Todos los archivos están en su lugar
    echo  🎉 Todas las modificaciones se aplicaron correctamente
    echo.
    echo  ╔════════════════════════════════════════════════════════╗
    echo  ║                                                        ║
    echo  ║      🚀 LISTO PARA INICIAR                            ║
    echo  ║                                                        ║
    echo  ║  Ejecuta: INICIAR_TODO.bat                            ║
    echo  ║                                                        ║
    echo  ╚════════════════════════════════════════════════════════╝
    echo.
) else (
    echo  ❌❌❌ SE ENCONTRARON %errors% ERRORES ❌❌❌
    echo.
    echo  Por favor verifica los archivos marcados con ❌
    echo.
)

echo ════════════════════════════════════════════════════════════════
echo.
echo  📚 DOCUMENTACIÓN DISPONIBLE:
echo     • RESUMEN_FINAL.md - Guía rápida
echo     • EVENTOS_3_TABS_README.md - Documentación completa
echo.
echo  🚀 PARA INICIAR:
echo     1. Ejecuta CREAR_EVENTOS_EJEMPLO.sql en Supabase
echo     2. Ejecuta INICIAR_TODO.bat
echo     3. Abre http://127.0.0.1:8000/estudiante/eventos
echo.
echo ════════════════════════════════════════════════════════════════
echo.
pause
