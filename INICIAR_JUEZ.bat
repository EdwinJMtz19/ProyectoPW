@echo off
echo ========================================
echo    EvenTec - Sistema de Jueces
echo ========================================
echo.
echo Iniciando servidor Laravel...
echo.

cd /d "%~dp0"

REM Verificar si composer está instalado
where composer >nul 2>nul
if %errorlevel% neq 0 (
    echo ERROR: Composer no está instalado o no está en el PATH
    echo Por favor instala Composer desde https://getcomposer.com
    pause
    exit /b
)

REM Verificar si PHP está instalado
where php >nul 2>nul
if %errorlevel% neq 0 (
    echo ERROR: PHP no está instalado o no está en el PATH
    echo Por favor instala PHP desde https://www.php.net/downloads
    pause
    exit /b
)

REM Instalar dependencias si no existen
if not exist vendor (
    echo Instalando dependencias de Composer...
    call composer install
    if %errorlevel% neq 0 (
        echo ERROR: Falló la instalación de dependencias
        pause
        exit /b
    )
)

REM Copiar archivo .env si no existe
if not exist .env (
    if exist .env.example (
        echo Copiando archivo .env.example a .env...
        copy .env.example .env
        echo Generando clave de aplicación...
        php artisan key:generate
    ) else (
        echo ERROR: No se encontró el archivo .env.example
        pause
        exit /b
    )
)

REM Limpiar caché
echo Limpiando caché...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo.
echo ========================================
echo    Servidor iniciado correctamente
echo ========================================
echo.
echo Accede a la aplicación en:
echo    http://localhost:8000
echo.
echo Rutas del Juez:
echo    Dashboard:    http://localhost:8000/juez/dashboard
echo    Eventos:      http://localhost:8000/juez/eventos
echo    Evaluaciones: http://localhost:8000/juez/evaluaciones
echo    Rankings:     http://localhost:8000/juez/rankings
echo    Perfil:       http://localhost:8000/juez/perfil
echo.
echo Presiona Ctrl+C para detener el servidor
echo ========================================
echo.

REM Iniciar el servidor
php artisan serve

pause
