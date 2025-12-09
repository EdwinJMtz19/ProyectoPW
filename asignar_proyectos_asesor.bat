@echo off
echo ============================================
echo   ASIGNAR PROYECTOS A ASESOR - PRUEBA
echo ============================================
echo.

php artisan tinker --execute="
$asesor = App\Models\User::where('email', 'ana.garcia@asesor.com')->first();
if ($asesor) {
    $proyectos = App\Models\Project::whereNull('advisor_id')->take(2)->get();
    foreach ($proyectos as $proyecto) {
        $proyecto->advisor_id = $asesor->id;
        $proyecto->save();
    }
    echo 'Proyectos asignados al asesor: ' . $proyectos->count();
} else {
    echo 'Asesor no encontrado';
}
"

echo.
echo ============================================
echo    COMPLETADO
echo ============================================
echo.
echo Ahora el asesor ana.garcia@asesor.com tiene proyectos asignados
echo.
pause
