-- Actualizar todos los eventos para que estén publicados
UPDATE events SET is_published = 1 WHERE is_published IS NULL OR is_published = 0;

-- Actualizar status de eventos según fechas actuales
UPDATE events 
SET status = CASE
    WHEN DATE(event_end_date) < DATE('now') THEN 'finished'
    WHEN DATE(event_start_date) <= DATE('now') AND DATE(event_end_date) >= DATE('now') THEN 'in_progress'
    ELSE 'upcoming'
END;

-- Verificar resultados
SELECT id, title, status, is_published, event_start_date, event_end_date 
FROM events 
ORDER BY event_start_date DESC;
