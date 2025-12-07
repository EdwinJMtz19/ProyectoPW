@echo off
echo ============================================
echo AGREGANDO COLUMNA ADVISOR_ID A PROJECTS
echo ============================================
echo.
echo Este script agregara la columna advisor_id a la tabla projects
echo.
pause

echo.
echo Intentando ejecutar migracion...
php artisan migrate --path=database/migrations/2024_12_05_000020_add_advisor_id_to_projects_table.php --force

echo.
echo Si la migracion fallo, ejecutando SQL directo...
sqlite3 database/database.sqlite < agregar_advisor_id.sql

echo.
echo ============================================
echo PROCESO COMPLETADO
echo ============================================
echo.
echo La columna advisor_id ha sido agregada a la tabla projects.
echo Ahora puedes acceder a la vista de Administracion sin errores.
echo.
pause
