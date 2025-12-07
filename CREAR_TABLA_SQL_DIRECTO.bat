@echo off
echo ============================================
echo CREANDO TABLA EVENT_ADVISORS (Metodo SQL)
echo ============================================
echo.
echo Este script creara la tabla event_advisors directamente en SQLite
echo.
pause

echo.
echo Ejecutando SQL...
sqlite3 database/database.sqlite < crear_event_advisors.sql

echo.
echo ============================================
echo TABLA CREADA
echo ============================================
echo.
echo La tabla event_advisors ha sido creada.
echo Ahora puedes acceder a la vista de eventos del admin.
echo.
pause
