@echo off
cls
echo LIMPIANDO CACHE DE VISTAS
echo.
php artisan view:clear
php artisan optimize:clear
echo.
echo LISTO - Recarga la pagina
echo http://127.0.0.1:8000/estudiante/proyectos
echo.
pause
