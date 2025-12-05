@echo off
echo ====================================
echo   CORRECCION TOTAL - VER DETALLES
echo ====================================
echo.
echo Ejecuta DIAGNOSTICO_VER_DETALLES.bat primero
echo para identificar el error especifico.
echo.
echo Luego comparte:
echo 1. URL generada
echo 2. Codigo de error (404, 403, 500)
echo 3. Mensaje de error
echo.
echo MIENTRAS TANTO, LIMPIANDO TODO:
echo.
php artisan view:clear
php artisan route:clear  
php artisan cache:clear
php artisan config:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   POSIBLES CAUSAS Y SOLUCIONES:
echo ========================================
echo.
echo ERROR 404 (Ruta no encontrada):
echo   Solucion: Verifica web.php
echo   Debe tener: Route::get('/equipos/{id}', ...)
echo.
echo ERROR 403 (Acceso denegado):
echo   Solucion: El usuario no es miembro
echo   Verifica en BD que seas miembro
echo.
echo ERROR 500 (Error del servidor):
echo   Solucion: Error en el controlador
echo   Revisa storage/logs/laravel.log
echo.
echo PAGINA EN BLANCO:
echo   Solucion: Error en la vista
echo   Verifica equipo-detalle.blade.php
echo.
echo ========================================
pause
