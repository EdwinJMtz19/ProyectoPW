@echo off
echo ====================================
echo   CORREGIR RUTA EQUIPOS
echo ====================================
echo.
echo Limpiando cache de rutas...
php artisan route:clear
echo.
echo Limpiando cache de configuracion...
php artisan config:clear
echo.
echo Limpiando cache general...
php artisan cache:clear
echo.
echo Limpiando cache de vistas...
php artisan view:clear
echo.
echo ✓ Todas las rutas corregidas
echo.
echo Puedes acceder ahora a:
echo http://127.0.0.1:8000/estudiante/equipos
echo.
pause
