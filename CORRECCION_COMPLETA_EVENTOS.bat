@echo off
echo ====================================
echo   CORRECCION COMPLETA EVENTOS
echo   Y DETECCION DE EQUIPOS
echo ====================================
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan cache:clear
php artisan config:clear
echo.
echo ✓ SISTEMA CORREGIDO COMPLETAMENTE
echo.
echo ========================================
echo   CORRECCIONES APLICADAS:
echo ========================================
echo.
echo 1. DETECCION MEJORADA DE "MI EQUIPO":
echo    ✓ Busca en event_registrations
echo    ✓ Cruza con team_members del usuario
echo    ✓ Carga objeto Team completo
echo    ✓ Fallback a sistema antiguo
echo.
echo 2. VALIDACION AL INSCRIBIR:
echo    ✓ Usuario es miembro
echo    ✓ Evento disponible (published + status)
echo    ✓ Equipo no inscrito previamente
echo    ✓ NINGUN miembro en otro equipo
echo    ✓ Limite de equipos
echo.
echo 3. VALIDACION AL CREAR EQUIPO:
echo    ✓ Usuario no esta en otro equipo
echo    ✓ Limite de equipos
echo.
echo 4. VALIDACION AL SOLICITAR UNIRSE:
echo    ✓ Usuario no esta en otro equipo
echo    ✓ No hay solicitud pendiente
echo.
echo ========================================
echo   LOGICA DE BOTONES EN VISTA:
echo ========================================
echo.
echo Para CADA equipo listado:
echo.
echo SI ($miEquipo and $miEquipo-^>id === $equipo-^>id):
echo    → Muestra: [Tu equipo] (verde)
echo    → Logica: Es TU equipo
echo.
echo ELSE SI ($miEquipo):
echo    → Muestra: [Ya tienes equipo] (gris)
echo    → Logica: Ya estas en OTRO equipo
echo.
echo ELSE SI (solicitud pendiente):
echo    → Muestra: [Solicitud enviada] (amarillo)
echo    → Logica: Ya enviaste solicitud
echo.
echo ELSE SI (equipo lleno):
echo    → Muestra: [Equipo lleno] (gris)
echo    → Logica: No hay espacio
echo.
echo ELSE:
echo    → Muestra: [Solicitar unirme] (azul)
echo    → Logica: Puede unirse
echo.
echo ========================================
echo   SIDEBAR - ACCIONES:
echo ========================================
echo.
echo SI ($miEquipo):
echo    → [✓ Ya estas inscrito]
echo    → [Equipo: nombre]
echo    → [Ver mi equipo] - Link funcional
echo.
echo ELSE SI (tiene equipos sin inscribir):
echo    → [Inscribir mi equipo]
echo    → [Crear nuevo equipo]
echo.
echo ELSE:
echo    → [Crear equipo]
echo.
echo ========================================
echo   FLUJO COMPLETO:
echo ========================================
echo.
echo CASO 1: Usuario SIN equipo
echo   1. Ve a Eventos
echo   2. Selecciona evento
echo   3. Ve equipos inscritos con [Solicitar unirme]
echo   4. Sidebar: [Inscribir mi equipo] o [Crear equipo]
echo.
echo CASO 2: Usuario CON equipo inscrito
echo   1. Ve a Eventos
echo   2. Selecciona evento
echo   3. Ve su equipo con [Tu equipo]
echo   4. Otros equipos: [Ya tienes equipo]
echo   5. Sidebar: [Ver mi equipo] - funciona
echo.
echo CASO 3: Usuario intenta inscribir 2do equipo
echo   1. Click [Inscribir mi equipo]
echo   2. Selecciona otro equipo
echo   3. ERROR: "Ya estas participando con equipo X"
echo.
echo ========================================
echo   VERIFICACION:
echo ========================================
echo.
echo 1. Ve a: http://localhost:8000/estudiante/eventos
echo 2. Click en "Feria Cientifica 2025"
echo 3. DEBE MOSTRAR:
echo    - En "equipo 1a": [Tu equipo]
echo    - Sidebar: [Ver mi equipo]
echo 4. Click "Ver mi equipo" - DEBE FUNCIONAR
echo.
echo ========================================
echo   SI AUN NO FUNCIONA:
echo ========================================
echo.
echo Ejecuta este SQL para ver tus datos:
echo.
echo SELECT 
echo   er.id as reg_id,
echo   t.id as team_id,
echo   t.name as equipo,
echo   e.title as evento,
echo   tm.user_id,
echo   u.name as usuario
echo FROM event_registrations er
echo JOIN teams t ON er.team_id = t.id
echo JOIN events e ON er.event_id = e.id
echo JOIN team_members tm ON t.id = tm.team_id
echo JOIN users u ON tm.user_id = u.id
echo WHERE u.email = 'carlos1@estudiante.com'
echo ORDER BY e.title, er.registered_at;
echo.
echo Debe mostrar SOLO UN equipo por evento.
echo Si ves DOS equipos, elimina uno:
echo.
echo DELETE FROM event_registrations 
echo WHERE id = 'REG_ID_A_ELIMINAR';
echo.
pause
