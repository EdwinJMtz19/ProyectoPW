@echo off
echo ============================================
echo CREANDO TABLA EVENT_ADVISORS
echo ============================================
echo.
echo Intentando ejecutar la migracion...
echo.

php artisan migrate --path=database/migrations/2024_12_06_000003_create_event_advisors_table.php --force

echo.
echo ============================================
echo PROCESO COMPLETADO
echo ============================================
echo.
echo Si ves "Migration table created successfully" o "Migrated:", 
echo entonces la tabla event_advisors fue creada correctamente.
echo.
echo Ahora puedes acceder a la vista de eventos del admin.
echo.
pause
