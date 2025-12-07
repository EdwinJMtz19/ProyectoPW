# CORRECCIONES APLICADAS - Campo user_type y relación projects()

## Problemas Identificados

### 1. Lista de jueces y asesores vacía
**Causa:** El sistema buscaba usuarios usando el campo `role`, pero en tu base de datos el campo se llama `user_type`.

**Valores en tu BD:**
- Jueces: `user_type = 'juez'`
- Asesores: `user_type = 'maestro'` (no 'asesor')

### 2. Error en vista de Administración
**Error:** `Call to undefined method App\Models\User::projects()`

**Causa:** El modelo User no tenía definida la relación `projects()`, solo `advisedProjects()`.

## Soluciones Aplicadas

### 1. Modelo User (`app/Models/User.php`)

#### Agregada nueva relación:
```php
/**
 * Relación con proyectos (alias para compatibilidad)
 */
public function projects()
{
    return $this->hasMany(Project::class, 'advisor_id');
}
```

Esta relación es un alias de `advisedProjects()` para mantener compatibilidad con el código que usa `->projects()`.

### 2. AdminController (`app/Http/Controllers/AdminController.php`)

#### Método `eventos()` - Corregido:
```php
// ANTES:
$jueces = User::where('role', 'juez')->get();
$asesores = User::where('role', 'asesor')->get();

// AHORA:
$jueces = User::where('user_type', 'juez')->orWhere('role', 'juez')->get();
$asesores = User::where('user_type', 'maestro')->orWhere('role', 'asesor')->get();
```

**Beneficios:**
- Busca en ambos campos (`user_type` y `role`) para máxima compatibilidad
- Reconoce que los asesores son `user_type = 'maestro'` en tu BD

#### Método `administracion()` - Corregido:

**Filtros:**
```php
// ANTES:
if ($role && $role !== 'all') {
    $query->where('role', $role);
}

// AHORA:
if ($role && $role !== 'all') {
    $query->where(function($q) use ($role) {
        $q->where('role', $role)->orWhere('user_type', $role);
    });
}
```

**Conteos:**
```php
// ANTES:
$totalEstudiantes = User::where('role', 'estudiante')->count();
$totalJueces = User::where('role', 'juez')->count();
$totalAsesores = User::where('role', 'asesor')->count();

// AHORA:
$totalEstudiantes = User::where('role', 'estudiante')->orWhere('user_type', 'estudiante')->count();
$totalJueces = User::where('role', 'juez')->orWhere('user_type', 'juez')->count();
$totalAsesores = User::where('role', 'asesor')->orWhere('user_type', 'maestro')->count();
```

## Resultados Esperados

### ✅ Al hacer clic en "Gestionar Jueces":
- Aparecerá la lista de todos los usuarios con `user_type = 'juez'`
- Podrás seleccionar múltiples jueces con checkboxes
- Los jueces previamente asignados aparecerán marcados

### ✅ Al hacer clic en "Gestionar Asesores":
- Aparecerá la lista de todos los usuarios con `user_type = 'maestro'`
- Podrás seleccionar múltiples asesores con checkboxes
- Los asesores previamente asignados aparecerán marcados

### ✅ En la vista de Administración:
- No habrá más error de `projects()`
- Los conteos mostrarán correctamente el número de usuarios de cada tipo
- Los filtros funcionarán correctamente

## Mapeo de Roles

| En Base de Datos | Rol Real | Campo |
|------------------|----------|-------|
| `user_type = 'estudiante'` | Estudiante | user_type |
| `user_type = 'juez'` | Juez | user_type |
| `user_type = 'maestro'` | Asesor/Maestro | user_type |
| `user_type = 'admin'` | Administrador | user_type |

El sistema ahora es **compatible con ambos esquemas** (role y user_type) para máxima flexibilidad.

## Archivos Modificados

1. ✅ `app/Models/User.php` - Agregada relación `projects()`
2. ✅ `app/Http/Controllers/AdminController.php` - Corregidas búsquedas para usar `user_type`

## Pruebas a Realizar

1. Entra como admin a la sección "Eventos"
2. Haz clic en "Gestionar Jueces" en cualquier evento
   - ✅ Debe mostrar lista de jueces
3. Haz clic en "Gestionar Asesores" en cualquier evento
   - ✅ Debe mostrar lista de asesores (maestros)
4. Entra a la sección "Administración"
   - ✅ No debe mostrar error
   - ✅ Los conteos deben ser correctos

¡Listo! Las correcciones están aplicadas y todo debe funcionar correctamente ahora.
