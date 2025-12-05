@echo off
echo ====================================
echo   DIAGNOSTICO VER DETALLES EQUIPOS
echo ====================================
echo.
echo PASOS PARA DIAGNOSTICAR:
echo.
echo 1. Abre la pagina /estudiante/equipos
echo 2. Presiona F12 (DevTools)
echo 3. Ve a la pestana "Network"
echo 4. Click en "Ver detalles" de cualquier equipo
echo 5. Observa que URL se genera
echo.
echo DEBE SER:
echo   /estudiante/equipos/{UUID}
echo   Ejemplo: /estudiante/equipos/9c8f2e10-abc4-...
echo.
echo SI VES:
echo   - 404 Not Found = Ruta no existe
echo   - 403 Forbidden = No tienes permiso
echo   - 500 Error = Error en el servidor
echo   - Pagina en blanco = Error en la vista
echo.
echo ========================================
echo   VERIFICACION DE RUTA:
echo ========================================
echo.
php artisan route:list | findstr "equipos.show"
echo.
echo DEBE MOSTRAR:
echo   GET    estudiante/equipos/{id}
echo   estudiante.equipos.show
echo.
echo ========================================
echo   VERIFICACION DE VISTA:
echo ========================================
echo.
if exist "D:\Cheluis\Documentos\7Semestre\Programacion web\ProyectoPW\resources\views\estudiante\equipo-detalle.blade.php" (
    echo ✓ Vista equipo-detalle.blade.php existe
) else (
    echo ✗ Vista equipo-detalle.blade.php NO EXISTE
)
echo.
echo ========================================
echo   PRUEBA MANUAL:
echo ========================================
echo.
echo Ejecuta este SQL para obtener un ID:
echo.
echo SELECT id, name FROM teams 
echo WHERE leader_id = (
echo   SELECT id FROM users 
echo   WHERE email = 'carlos1@estudiante.com'
echo )
echo LIMIT 1;
echo.
echo Copia el ID y prueba en el navegador:
echo   http://localhost:8000/estudiante/equipos/{ID}
echo.
echo Si funciona manualmente pero no desde el boton,
echo el problema es el link en la vista.
echo.
echo ========================================
echo   LIMPIANDO CACHE:
echo ========================================
echo.
php artisan view:clear
php artisan route:clear
php artisan cache:clear
echo.
echo ✓ Cache limpiado
echo.
echo ========================================
echo   SIGUIENTE PASO:
echo ========================================
echo.
echo Por favor comparte:
echo.
echo 1. URL que se genera cuando haces click
echo 2. Mensaje de error que ves (si hay)
echo 3. Codigo de estado (404, 403, 500, etc)
echo.
echo Puedes ver esto en:
echo   DevTools (F12) ^> Network ^> Click Ver detalles
echo.
pause
