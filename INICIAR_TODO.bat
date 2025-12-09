@echo off
chcp 65001 >nul
color 0A
echo.
echo ╔════════════════════════════════════════════════════════════════╗
echo ║                                                                ║
echo ║        🎯 VISTA DE EVENTOS - 3 TABS COMPLETADA ✅             ║
echo ║                                                                ║
echo ╚════════════════════════════════════════════════════════════════╝
echo.
echo  ✅ ARCHIVOS MODIFICADOS:
echo     • EventoController.php
echo     • eventos.blade.php  
echo     • evento-card.blade.php (nuevo)
echo.
echo  🎨 CARACTERÍSTICAS:
echo     • 3 tabs: Próximos, Activos y Terminados
echo     • Muestra TODOS los eventos de la BD
echo     • Filtrado por categoría y búsqueda
echo     • Contadores dinámicos
echo     • Badges de estado animados
echo     • Diseño responsive
echo.
echo ════════════════════════════════════════════════════════════════
echo  📋 PASO 1: CREAR EVENTOS DE EJEMPLO (Recomendado)
echo ════════════════════════════════════════════════════════════════
echo.
echo  1. Ve a: https://supabase.com
echo  2. Abre tu proyecto
echo  3. Ve a SQL Editor (⚡)
echo  4. Abre: CREAR_EVENTOS_EJEMPLO.sql
echo  5. Copia TODO el contenido
echo  6. Pégalo en Supabase SQL Editor
echo  7. Presiona "Run" (F5)
echo.
echo  Esto creará 8 eventos:
echo     ✓ 3 Próximos (Hackathon, Feria Ciencias, Startup Weekend)
echo     ✓ 2 Activos (Robótica, Code Challenge)
echo     ✓ 3 Terminados (IA 2024, Emprendimiento, Olimpiada)
echo.
pause
cls
echo.
echo ════════════════════════════════════════════════════════════════
echo  🚀 PASO 2: INICIAR SERVIDOR
echo ════════════════════════════════════════════════════════════════
echo.
echo  Limpiando caché...

call php artisan config:clear >nul 2>&1
call php artisan view:clear >nul 2>&1
call php artisan cache:clear >nul 2>&1
call php artisan route:clear >nul 2>&1

echo  ✅ Caché limpiado
echo.
echo ════════════════════════════════════════════════════════════════
echo  📱 ACCEDE A LA APLICACIÓN
echo ════════════════════════════════════════════════════════════════
echo.
echo  🌐 URL: http://127.0.0.1:8000/estudiante/eventos
echo.
echo  👤 Inicia sesión con un usuario estudiante:
echo     Email: carlos@estudiante.com
echo     Password: password123
echo.
echo ════════════════════════════════════════════════════════════════
echo  ✨ QUÉ VERÁS:
echo ════════════════════════════════════════════════════════════════
echo.
echo  📅 TAB PRÓXIMOS (activo por defecto)
echo     • Eventos que aún no han iniciado
echo     • Puedes inscribirte
echo     • Badge azul "Próximamente"
echo.
echo  🟢 TAB ACTIVOS
echo     • Eventos en curso ahora
echo     • Badge verde "En Curso" con animación
echo.
echo  ⚫ TAB TERMINADOS
echo     • Eventos que ya concluyeron
echo     • Badge gris "Finalizado"
echo.
echo ════════════════════════════════════════════════════════════════
echo  🎮 PRUEBA ESTAS FUNCIONES:
echo ════════════════════════════════════════════════════════════════
echo.
echo  ✓ Cambiar entre tabs (Próximos/Activos/Terminados)
echo  ✓ Buscar eventos (escribe en el buscador)
echo  ✓ Filtrar por categoría (dropdown)
echo  ✓ Ver contadores dinámicos en cada tab
echo  ✓ Click en "Ver detalles" de cualquier evento
echo.
echo ════════════════════════════════════════════════════════════════
echo  📚 DOCUMENTACIÓN COMPLETA:
echo ════════════════════════════════════════════════════════════════
echo.
echo  Lee: EVENTOS_3_TABS_README.md
echo.
echo  Contiene:
echo     • Explicación detallada de cada archivo
echo     • Cómo funciona la clasificación de eventos
echo     • Estructura de la vista
echo     • Solución de problemas
echo     • Testing y casos de prueba
echo.
echo ════════════════════════════════════════════════════════════════
echo.
echo  🚀 Iniciando servidor Laravel...
echo.
echo  Presiona Ctrl+C para detener el servidor
echo.
echo ════════════════════════════════════════════════════════════════
echo.

php artisan serve
