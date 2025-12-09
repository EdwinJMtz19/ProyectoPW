@echo off
cls
echo.
echo ════════════════════════════════════════════
echo   🚀 INICIO ULTRA RÁPIDO
echo ════════════════════════════════════════════
echo.
echo  Limpiando caché...
call php artisan config:clear >nul 2>&1
call php artisan view:clear >nul 2>&1
call php artisan cache:clear >nul 2>&1
echo  ✅ Listo
echo.
echo  Iniciando servidor...
echo.
echo  📍 URL: http://127.0.0.1:8000/estudiante/eventos
echo.
php artisan serve
