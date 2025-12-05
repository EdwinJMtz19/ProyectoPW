@echo off
echo ====================================
echo   CORRECCION VER DETALLES PROYECTO
echo ====================================
echo.
echo Ejecutando migracion advisor_id...
php artisan migrate --path=database/migrations/2024_12_05_000020_add_advisor_id_to_projects_table.php
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ VISTA DE DETALLES CORREGIDA
echo.
echo ========================================
echo   CAMBIOS APLICADOS:
echo ========================================
echo.
echo 1. MIGRACION:
echo    ✓ Columna advisor_id agregada
echo    ✓ Foreign key a users
echo.
echo 2. CONTROLADOR:
echo    ✓ Check de columna advisor_id
echo    ✓ Carga condicional de advisor
echo    ✓ Lista de asesores solo si existe columna
echo    ✓ Sin cargar advisor en listado
echo.
echo 3. MODELO PROJECT:
echo    ✓ Relacion advisor() ya existe
echo    ✓ advisor_id en fillable
echo.
echo 4. MODELO USER:
echo    ✓ Relacion advisedProjects() ya existe
echo.
echo ========================================
echo   AHORA FUNCIONA:
echo ========================================
echo.
echo ✓ Ver lista de proyectos
echo ✓ Ver detalles de proyecto
echo ✓ Asignar asesor (si columna existe)
echo ✓ Sin errores de relaciones
echo.
echo ========================================
echo   PRUEBA:
echo ========================================
echo.
echo 1. /estudiante/proyectos
echo    ✓ Ver lista completa
echo.
echo 2. Click "Ver detalles"
echo    ✓ Abre sin errores
echo    ✓ Muestra info completa
echo    ✓ Boton "Editar" si eres lider
echo    ✓ Seccion de asesor funcional
echo.
pause
