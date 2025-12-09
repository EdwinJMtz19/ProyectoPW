@echo off
echo.
echo ========================================
echo   ACTUALIZANDO BD DIRECTAMENTE
echo ========================================
echo.

REM Obtener la ruta de la base de datos del archivo .env
for /f "tokens=2 delims==" %%a in ('findstr /i "DB_DATABASE" .env') do set DB_PATH=%%a

if "%DB_PATH%"=="" (
    echo Error: No se pudo encontrar la ruta de la base de datos en .env
    pause
    exit /b 1
)

echo Base de datos: %DB_PATH%
echo.

REM Ejecutar el SQL
sqlite3 %DB_PATH% < ACTUALIZAR_EVENTOS_SQL.sql

if %errorlevel% equ 0 (
    echo.
    echo ✓ Base de datos actualizada correctamente
    echo.
    echo Verificando eventos...
    echo.
    sqlite3 %DB_PATH% "SELECT title, status, is_published FROM events;"
) else (
    echo.
    echo ✗ Error al actualizar la base de datos
)

echo.
echo Presiona cualquier tecla para continuar...
pause > nul
