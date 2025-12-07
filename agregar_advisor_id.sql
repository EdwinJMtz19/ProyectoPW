-- Agregar columna advisor_id a la tabla projects si no existe
ALTER TABLE projects ADD COLUMN advisor_id TEXT;

-- Crear índice para advisor_id
CREATE INDEX IF NOT EXISTS idx_projects_advisor_id ON projects(advisor_id);
