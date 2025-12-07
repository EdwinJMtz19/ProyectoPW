# Sistema de Gestión de Eventos - Panel de Administrador

## ✅ Archivos Creados

### Vistas de Administrador
- `resources/views/layouts/admin.blade.php` - Layout principal
- `resources/views/admin/dashboard.blade.php` - Dashboard principal
- `resources/views/admin/eventos.blade.php` - Gestión de eventos
- `resources/views/admin/equipos.blade.php` - Gestión de equipos
- `resources/views/admin/rankings.blade.php` - Rankings y estadísticas
- `resources/views/admin/administracion.blade.php` - Panel de administración de usuarios
- `resources/views/admin/mi-perfil.blade.php` - Perfil del administrador

### Controladores
- `app/Http/Controllers/AdminController.php` - Controlador principal del admin

### Middlewares de Protección
- `app/Http/Middleware/CheckAdmin.php` - Verifica acceso de administrador
- `app/Http/Middleware/CheckEstudiante.php` - Verifica acceso de estudiante
- `app/Http/Middleware/CheckJuez.php` - Verifica acceso de juez
- `app/Http/Middleware/CheckAsesor.php` - Verifica acceso de asesor

### Configuración
- `bootstrap/app.php` - Registro de middlewares
- `routes/web.php` - Rutas protegidas con middlewares
- `resources/views/errors/403.blade.php` - Vista de error personalizada

## 🔒 Sistema de Permisos

### Roles del Sistema
1. **Administrador** (`administrador` o `admin`)
   - Acceso completo al sistema
   - Gestiona eventos, equipos, usuarios
   - Panel de administración exclusivo

2. **Estudiante** (`estudiante`)
   - Vista de eventos y proyectos
   - Participación en equipos

3. **Juez** (`juez`)
   - Evaluación de proyectos
   - Visualización de rankings

4. **Asesor/Maestro** (`maestro` o `asesor`)
   - Supervisión de equipos
   - Seguimiento de proyectos

## 🚀 Rutas Protegidas

### Rutas de Administrador (requieren rol `administrador` o `admin`)
```
/admin/dashboard          - Dashboard principal
/admin/eventos            - Gestión de eventos
/admin/equipos            - Gestión de equipos
/admin/rankings           - Rankings y estadísticas
/admin/administracion     - Panel de usuarios
/admin/perfil             - Perfil del admin
```

### Cómo Funcionan los Middlewares

1. **Autenticación**: Todas las rutas requieren que el usuario esté autenticado
2. **Verificación de Rol**: El middleware verifica el campo `rol` o `user_type` del usuario
3. **Acceso Denegado**: Si el usuario no tiene el rol correcto, se muestra error 403

## 🧪 Cómo Probar

### 1. Crear Usuario Administrador

Desde la consola de Laravel (tinker):
```bash
php artisan tinker
```

Luego ejecutar:
```php
$admin = new App\Models\User();
$admin->name = 'Administrador del Sistema';
$admin->email = 'admin@eventec.com';
$admin->password = bcrypt('password123');
$admin->numero_control = 'ADMIN001';
$admin->rol = 'administrador'; // o 'admin'
$admin->save();
```

### 2. Iniciar Sesión

1. Ir a: `http://localhost/login`
2. Usar las credenciales:
   - Email: `admin@eventec.com`
   - Password: `password123`

3. Serás redirigido automáticamente a `/admin/dashboard`

### 3. Probar Restricciones de Acceso

**Escenario 1: Admin intenta acceder a área de estudiante**
- Ir a: `http://localhost/estudiante/dashboard`
- Resultado: Error 403 - "No tienes permiso para acceder a esta área de Estudiantes"

**Escenario 2: Estudiante intenta acceder a área de admin**
- Iniciar sesión como estudiante
- Ir a: `http://localhost/admin/dashboard`
- Resultado: Error 403 - "No tienes permiso para acceder a esta área de Administrador"

## 🎨 Características de Diseño

### Colores del Admin
- Gradiente principal: Rojo a Naranja (`from-red-500 to-orange-600`)
- Diferente a otros roles para identificación visual

### Componentes Incluidos
- ✅ Tarjetas de estadísticas
- ✅ Filtros de búsqueda
- ✅ Tablas responsivas
- ✅ Gráficos de actividad
- ✅ Acciones rápidas
- ✅ Panel lateral con información
- ✅ Paginación
- ✅ Formularios estilizados

## 🔧 Mantenimiento

### Agregar Nueva Ruta Protegida

1. Agregar en `routes/web.php`:
```php
Route::get('/admin/nueva-ruta', [AdminController::class, 'nuevaRuta'])
    ->name('admin.nueva-ruta');
```

2. Agregar método en `AdminController.php`:
```php
public function nuevaRuta()
{
    return view('admin.nueva-vista');
}
```

3. La ruta ya estará protegida por el middleware `admin`

### Cambiar Verificación de Roles

Si necesitas verificar otros campos en la tabla de usuarios, edita los middlewares en:
- `app/Http/Middleware/CheckAdmin.php`
- `app/Http/Middleware/CheckEstudiante.php`
- `app/Http/Middleware/CheckJuez.php`
- `app/Http/Middleware/CheckAsesor.php`

## 📱 Navegación

El sidebar incluye:
- Dashboard
- Eventos
- Equipos
- Rankings
- Administración
- Mi Perfil

Todos con iconos SVG y estados activos visuales.

## ⚠️ Notas Importantes

1. **Campo de Rol**: El sistema verifica tanto `rol` como `user_type` para compatibilidad
2. **Redirección Automática**: Al hacer login, los usuarios son redirigidos según su rol
3. **Error 403**: Página personalizada que muestra un mensaje amigable y botón de regreso
4. **Middlewares Globales**: Registrados en `bootstrap/app.php` con alias cortos

## 🔐 Seguridad

- ✅ Todas las rutas protegidas con autenticación
- ✅ Verificación de roles en cada solicitud
- ✅ Mensajes de error personalizados
- ✅ Regeneración de sesión al hacer login
- ✅ Invalidación de sesión al hacer logout

## 📚 Próximos Pasos

1. Conectar con base de datos real
2. Implementar CRUD completo para eventos
3. Implementar CRUD completo para usuarios
4. Agregar validaciones en formularios
5. Implementar subida de archivos
6. Agregar notificaciones en tiempo real
