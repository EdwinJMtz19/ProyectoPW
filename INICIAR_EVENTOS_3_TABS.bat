@echo off
chcp 65001 >nul
echo ========================================
echo 🎯 ACTUALIZACIÓN: Vista de Eventos con 3 Tabs
echo ========================================
echo.

echo ✅ Archivos actualizados:
echo    - EventoController.php (3 tipos de eventos)
echo    - eventos.blade.php (Tabs: Próximos/Activos/Terminados)
echo    - evento-card.blade.php (Tarjeta dinámica de eventos)
echo.

echo 📋 Limpiando caché de Laravel...
call php artisan config:clear >nul 2>&1
call php artisan view:clear >nul 2>&1
call php artisan cache:clear >nul 2>&1
call php artisan route:clear >nul 2>&1

echo ✅ Caché limpiado
echo.

echo 🚀 Iniciando servidor Laravel...
echo.
echo 💡 Abre tu navegador en: http://127.0.0.1:8000/estudiante/eventos
echo.
echo ✨ CARACTERÍSTICAS:
echo    ✓ 3 tabs: Próximos, Activos y Terminados
echo    ✓ Muestra TODOS los eventos de la BD
echo    ✓ Filtrado por categoría y búsqueda
echo    ✓ Diseño moderno con badges de estado
echo    ✓ Contador dinámico por tab
echo.
echo Presiona Ctrl+C para detener el servidor
echo ========================================
echo.

php artisan serve
