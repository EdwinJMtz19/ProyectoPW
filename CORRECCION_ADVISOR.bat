@echo off
echo ====================================
echo   CORRECCION RELACION ADVISOR
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
echo.
echo ✓ RELACION ADVISOR AGREGADA
echo.
echo ========================================
echo   CAMBIOS APLICADOS:
echo ========================================
echo.
echo 1. MODELO PROJECT:
echo    ✓ Agregado advisor_id en fillable
echo    ✓ Agregado submission_file_path en fillable
echo    ✓ Agregado submission_file_name en fillable
echo    ✓ Relacion advisor() con User
echo.
echo 2. MODELO USER:
echo    ✓ Relacion advisedProjects()
echo    ✓ Soporte para campo "role"
echo    ✓ Metodos de verificacion mejorados
echo.
echo ========================================
echo   AHORA SI DEBERIA FUNCIONAR:
echo ========================================
echo.
echo /estudiante/proyectos
echo.
echo ✓ Sin errores de relaciones
echo ✓ Carga correcta de proyectos
echo ✓ Info de asesor disponible
echo.
pause
