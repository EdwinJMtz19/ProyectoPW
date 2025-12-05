@echo off
echo ====================================
echo   VALIDACIONES COMPLETAS PROYECTOS
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
echo.
echo ✓ VALIDACIONES IMPLEMENTADAS
echo.
echo ========================================
echo   VALIDACIONES AL CREAR PROYECTO:
echo ========================================
echo.
echo 1. Usuario es miembro del equipo
echo    ✗ Si no es miembro: ERROR
echo.
echo 2. Evento esta disponible:
echo    ✓ Debe estar publicado
echo    ✓ No debe haber terminado
echo    ✓ Registro debe estar abierto
echo    ✗ Si no cumple: ERROR especifico
echo.
echo 3. Equipo NO inscrito previamente:
echo    ✗ Si ya esta inscrito: "Ya estas inscrito"
echo.
echo 4. Limite de equipos:
echo    ✗ Si esta lleno: "Limite alcanzado"
echo.
echo 5. Ningun miembro en otro equipo:
echo    ✗ Si hay conflicto: "Miembro ya participa"
echo.
echo ========================================
echo   FILTRO DE EVENTOS DISPONIBLES:
echo ========================================
echo.
echo SOLO MUESTRA EVENTOS QUE:
echo    ✓ Estan publicados
echo    ✓ NO han terminado
echo    ✓ Tienen registro abierto
echo    ✓ O empiezan en los proximos 7 dias
echo.
echo NO MUESTRA:
echo    ✗ Eventos finalizados
echo    ✗ Con registro cerrado hace tiempo
echo    ✗ No publicados
echo.
echo ========================================
echo   FUNCIONAMIENTO:
echo ========================================
echo.
echo AL ABRIR MODAL "Nuevo Proyecto":
echo    - Select equipo: TODOS tus equipos
echo    - Select evento: SOLO eventos disponibles
echo    - Si equipo ya inscrito en evento: ERROR
echo    - Si evento lleno: ERROR
echo    - Si miembro participa: ERROR
echo.
echo VER DETALLES:
echo    - Acceso solo si eres miembro
echo    - Info completa del proyecto
echo    - Opciones segun rol (lider/miembro)
echo.
echo ========================================
pause
