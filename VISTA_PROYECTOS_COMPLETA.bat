@echo off
echo ====================================
echo   VISTA DE PROYECTOS COMPLETA
echo   + SISTEMA DE ENTREGA DE ARCHIVOS
echo ====================================
echo.
echo Ejecutando migracion...
php artisan migrate --path=database/migrations/2024_12_05_000010_add_submission_file_to_projects_table.php
echo.
echo Creando directorio de entregas...
mkdir public\storage\submissions 2>nul
echo.
echo Limpiando cache...
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan storage:link
echo.
echo ✓ VISTA DE PROYECTOS 100%% FUNCIONAL
echo.
echo ========================================
echo   FUNCIONALIDADES IMPLEMENTADAS:
echo ========================================
echo.
echo 1. LISTA DE PROYECTOS:
echo    ✓ Cards con badges de estado:
echo      - Borrador (gris)
echo      - En progreso (azul)
echo      - Entregado (verde)
echo      - Evaluado (morado)
echo    ✓ Info del equipo y evento
echo    ✓ Info del asesor (si tiene)
echo    ✓ Puntuacion final (si esta evaluado)
echo    ✓ Modal crear proyecto funcional
echo.
echo 2. DETALLE DE PROYECTO:
echo    ✓ Header con degradado morado
echo    ✓ Estado del proyecto
echo    ✓ Puntuacion (si evaluado)
echo    ✓ Informacion completa
echo    ✓ Links a repositorio y demo
echo    ✓ Boton editar (solo lider)
echo.
echo 3. SISTEMA DE ENTREGA DE ARCHIVOS:
echo    ✓ Seccion dedicada "Entrega del Proyecto"
echo    ✓ Subir archivo (solo lider)
echo      - Formatos: PDF, ZIP, RAR, DOCX, PPTX
echo      - Tamano maximo: 50MB
echo    ✓ Descargar archivo entregado
echo    ✓ Eliminar entrega (solo antes de evaluar)
echo    ✓ Estados visuales:
echo      - Sin entrega (gris con boton)
echo      - Entregado (verde con info)
echo      - Evaluado (morado, solo descarga)
echo.
echo 4. GESTION DE ASESORES:
echo    ✓ Seccion "Asesor del Proyecto"
echo    ✓ Sin asesor: boton seleccionar
echo    ✓ Con asesor: info + boton cambiar
echo    ✓ Modal con lista de asesores disponibles
echo    ✓ Click en asesor = asignacion
echo.
echo 5. EQUIPO Y EVENTO:
echo    ✓ Lista de miembros del equipo
echo    ✓ Badge especial para lider
echo    ✓ Links a equipo y evento
echo    ✓ Sidebar con info resumida
echo.
echo ========================================
echo   FLUJO DE ENTREGA:
echo ========================================
echo.
echo ESTUDIANTE (Lider):
echo   1. Termina el proyecto
echo   2. Click "Entregar archivo"
echo   3. Modal abre
echo   4. Selecciona archivo (PDF/ZIP/etc)
echo   5. Click "Entregar"
echo   6. ✓ Archivo subido
echo   7. ✓ Estado = "submitted"
echo   8. ✓ submitted_at guardado
echo   9. Proyecto aparece en lista de jueces
echo.
echo JUEZ:
echo   1. Ve lista de proyectos entregados
echo   2. Click en proyecto
echo   3. Ve info + boton "Descargar entrega"
echo   4. Descarga archivo
echo   5. Evalua proyecto
echo   6. ✓ Estado = "evaluated"
echo   7. ✓ Ya no se puede eliminar entrega
echo.
echo ========================================
echo   RUTAS AGREGADAS:
echo ========================================
echo.
echo POST   /proyectos/{id}/submit-file
echo GET    /proyectos/{id}/download-submission
echo DELETE /proyectos/{id}/delete-submission
echo.
echo ========================================
echo   BASE DE DATOS:
echo ========================================
echo.
echo PROJECTS (nuevos campos):
echo   - submission_file_path (ruta del archivo)
echo   - submission_file_name (nombre original)
echo   - submitted_at (timestamp de entrega)
echo.
echo ========================================
echo   ARCHIVOS CREADOS/ACTUALIZADOS:
echo ========================================
echo.
echo ✓ Migracion: add_submission_file_to_projects
echo ✓ ProyectoController:
echo   - submitFile() - Subir archivo
echo   - downloadSubmission() - Descargar
echo   - deleteSubmission() - Eliminar
echo ✓ routes/web.php - Nuevas rutas
echo ✓ proyectos.blade.php - Lista completa
echo ✓ proyecto-detalle.blade.php - Con entrega
echo.
echo ========================================
pause
