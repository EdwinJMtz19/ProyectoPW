-- Crear tabla event_advisors manualmente
CREATE TABLE IF NOT EXISTS event_advisors (
    id TEXT PRIMARY KEY,
    event_id TEXT NOT NULL,
    advisor_id TEXT NOT NULL,
    status TEXT DEFAULT 'active' CHECK(length(status) <= 20),
    assigned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    assigned_by TEXT,
    notes TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    UNIQUE(event_id, advisor_id)
);

-- Crear índices
CREATE INDEX IF NOT EXISTS idx_event_advisors_event_id ON event_advisors(event_id);
CREATE INDEX IF NOT EXISTS idx_event_advisors_advisor_id ON event_advisors(advisor_id);
