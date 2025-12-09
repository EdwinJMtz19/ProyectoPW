@echo off
cls
echo ACTUALIZANDO FILTROS DE ESTADO
echo.
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo.
php artisan config:cache
php artisan route:cache
echo.
echo LISTO
echo - Estados actualizados: Borrador, Abierto, En Curso, Cerrado, Finalizado
echo - Filtro funcional
echo - Badges visibles en cada evento
echo.
echo Recarga: http://127.0.0.1:8000/admin/eventos
echo.
pause
