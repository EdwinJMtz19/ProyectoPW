@echo off
echo ========================================
echo ASIGNAR JUECES A EVENTOS - EvenTec
echo ========================================
echo.

echo [1/2] Ejecutando migracion para crear tabla event_judges...
php artisan migrate --path=database/migrations/2024_12_01_000002_create_event_judges_table.php
echo.

echo [2/2] Asignando jueces a eventos...
php artisan db:seed --class=EventJudgeSeeder
echo.

echo ========================================
echo PROCESO COMPLETADO
echo ========================================
echo.
echo Los jueces han sido asignados a los eventos.
echo Ahora puedes iniciar sesion como juez y ver tus eventos asignados.
echo.
echo Credenciales de juez:
echo Email: juez@example.com
echo Password: password
echo.
pause
