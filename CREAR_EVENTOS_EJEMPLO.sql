-- ========================================
-- 🎯 EVENTOS DE EJEMPLO: Próximos, Activos y Terminados
-- ========================================
-- Este script crea eventos en los 3 estados para probar la nueva vista

-- Primero, vamos a limpiar eventos anteriores (opcional, comentar si no quieres)
-- DELETE FROM events;

-- ========================================
-- 📅 EVENTOS PRÓXIMOS (3 eventos)
-- ========================================

-- Evento 1: Hackathon 2025
INSERT INTO events (
    id, title, slug, description, short_description, category, 
    event_type, status, registration_start_date, registration_end_date,
    event_start_date, event_end_date, min_team_size, max_team_size,
    max_teams, location, venue, is_online, requirements, prizes,
    cover_image_url, organizer_name, contact_email, contact_phone,
    views_count, registered_teams_count, is_featured, is_published,
    created_at, updated_at
) VALUES (
    gen_random_uuid(),
    'Hackathon Innovación 2025',
    'hackathon-innovacion-2025',
    'Desarrolla soluciones tecnológicas innovadoras en 48 horas. Desafía tus habilidades de programación, diseño y trabajo en equipo. Premios de hasta $50,000 MXN para los mejores proyectos.',
    'Desarrolla soluciones tecnológicas innovadoras en 48 horas',
    'Tecnología',
    'hackathon',
    'upcoming',
    CURRENT_DATE,
    CURRENT_DATE + INTERVAL '15 days',
    CURRENT_DATE + INTERVAL '20 days',
    CURRENT_DATE + INTERVAL '22 days',
    3, 5, 30,
    'Campus Tecnológico',
    'Auditorio Principal',
    false,
    '["Laptop personal", "Conocimientos de programación", "Mayoría de edad"]'::jsonb,
    '["1er Lugar: $50,000 MXN", "2do Lugar: $30,000 MXN", "3er Lugar: $20,000 MXN"]'::jsonb,
    'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800',
    'Dirección de Innovación',
    'innovacion@eventec.com',
    '+52 81 1234 5678',
    145, 0, true, true,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
) ON CONFLICT (id) DO NOTHING;

-- Evento 2: Feria de Ciencias
INSERT INTO events (
    id, title, slug, description, short_description, category, 
    event_type, status, registration_start_date, registration_end_date,
    event_start_date, event_end_date, min_team_size, max_team_size,
    max_teams, location, is_online, requirements, prizes,
    cover_image_url, organizer_name, contact_email,
    views_count, registered_teams_count, is_featured, is_published,
    created_at, updated_at
) VALUES (
    gen_random_uuid(),
    'Feria Nacional de Ciencias 2025',
    'feria-ciencias-2025',
    'Presenta tu proyecto científico ante jueces expertos. Categorías: Biología, Química, Física, Matemáticas. Gran oportunidad para demostrar tus habilidades de investigación.',
    'Presenta tu proyecto científico ante jueces expertos',
    'Ciencias',
    'exhibition',
    'upcoming',
    CURRENT_DATE - INTERVAL '5 days',
    CURRENT_DATE + INTERVAL '25 days',
    CURRENT_DATE + INTERVAL '30 days',
    CURRENT_DATE + INTERVAL '31 days',
    2, 4, 50,
    'Centro de Convenciones',
    false,
    '["Proyecto científico completo", "Póster de presentación", "Prototipo funcional"]'::jsonb,
    '["Medalla de Oro", "Beca de $100,000 MXN", "Publicación en revista científica"]'::jsonb,
    'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=800',
    'Asociación de Científicos',
    'ciencias@eventec.com',
    89, 0, false, true,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
) ON CONFLICT (id) DO NOTHING;

-- Evento 3: Startup Weekend
INSERT INTO events (
    id, title, slug, description, short_description, category, 
    event_type, status, registration_start_date, registration_end_date,
    event_start_date, event_end_date, min_team_size, max_team_size,
    max_teams, location, venue, is_online, requirements, prizes,
    cover_image_url, organizer_name, contact_email,
    views_count, registered_teams_count, is_featured, is_published,
    created_at, updated_at
) VALUES (
    gen_random_uuid(),
    'Startup Weekend 2025',
    'startup-weekend-2025',
    'Crea tu startup en 54 horas. Desde la idea hasta el pitch. Mentoría de emprendedores exitosos, sesiones de networking y oportunidad de conseguir inversión.',
    'Crea tu startup en 54 horas',
    'Negocios',
    'competition',
    'upcoming',
    CURRENT_DATE,
    CURRENT_DATE + INTERVAL '10 days',
    CURRENT_DATE + INTERVAL '15 days',
    CURRENT_DATE + INTERVAL '17 days',
    2, 5, 20,
    'Hub de Innovación',
    'Sala Emprendedores',
    false,
    '["Idea de negocio", "Laptop", "Ganas de emprender"]'::jsonb,
    '["Inversión semilla $200,000 MXN", "Incubación 6 meses", "Mentoría personalizada"]'::jsonb,
    'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=800',
    'Tech Hub',
    'startups@eventec.com',
    234, 0, true, true,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
) ON CONFLICT (id) DO NOTHING;

-- ========================================
-- 🟢 EVENTOS ACTIVOS (2 eventos)
-- ========================================

-- Evento 4: Robótica Competitiva (ACTIVO AHORA)
INSERT INTO events (
    id, title, slug, description, short_description, category, 
    event_type, status, registration_start_date, registration_end_date,
    event_start_date, event_end_date, min_team_size, max_team_size,
    max_teams, location, venue, is_online, requirements, prizes,
    cover_image_url, organizer_name, contact_email,
    views_count, registered_teams_count, is_featured, is_published,
    created_at, updated_at
) VALUES (
    gen_random_uuid(),
    'Competencia de Robótica 2024',
    'robotica-2024',
    'Torneo de robots autónomos. Desafíos de navegación, manipulación y resolución de problemas. Tu robot debe completar misiones específicas en el menor tiempo posible.',
    'Torneo de robots autónomos con múltiples desafíos',
    'Robótica',
    'competition',
    'in_progress',
    CURRENT_DATE - INTERVAL '45 days',
    CURRENT_DATE - INTERVAL '10 days',
    CURRENT_DATE - INTERVAL '2 days',
    CURRENT_DATE + INTERVAL '3 days',
    3, 5, 25,
    'Arena Robótica',
    'Pista Principal',
    false,
    '["Robot funcional", "Kit de herramientas", "Baterías de respaldo"]'::jsonb,
    '["Trofeo Copa de Oro", "$40,000 MXN", "Kit Arduino avanzado"]'::jsonb,
    'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800',
    'Club de Robótica',
    'robotica@eventec.com',
    512, 18, true, true,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
) ON CONFLICT (id) DO NOTHING;

-- Evento 5: Code Challenge (ACTIVO)
INSERT INTO events (
    id, title, slug, description, short_description, category, 
    event_type, status, registration_start_date, registration_end_date,
    event_start_date, event_end_date, min_team_size, max_team_size,
    max_teams, location, is_online, meeting_url, requirements, prizes,
    cover_image_url, organizer_name, contact_email,
    views_count, registered_teams_count, is_featured, is_published,
    created_at, updated_at
) VALUES (
    gen_random_uuid(),
    'Code Challenge Marathon',
    'code-challenge-marathon',
    'Maratón de programación en línea. Resuelve algoritmos complejos, optimiza código y demuestra tus habilidades. Rankings en tiempo real.',
    'Maratón de programación en línea',
    'Tecnología',
    'competition',
    'in_progress',
    CURRENT_DATE - INTERVAL '30 days',
    CURRENT_DATE - INTERVAL '7 days',
    CURRENT_DATE - INTERVAL '1 day',
    CURRENT_DATE + INTERVAL '5 days',
    1, 2, 100,
    'En línea',
    true,
    'https://meet.google.com/code-challenge',
    '["Cuenta en plataforma", "Conocimientos de algoritmos", "Internet estable"]'::jsonb,
    '["Certificación internacional", "$25,000 MXN", "Curso premium de programación"]'::jsonb,
    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800',
    'Academia de Código',
    'code@eventec.com',
    678, 45, false, true,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
) ON CONFLICT (id) DO NOTHING;

-- ========================================
-- ⚫ EVENTOS TERMINADOS (3 eventos)
-- ========================================

-- Evento 6: Hackathon 2024 (TERMINADO)
INSERT INTO events (
    id, title, slug, description, short_description, category, 
    event_type, status, registration_start_date, registration_end_date,
    event_start_date, event_end_date, min_team_size, max_team_size,
    max_teams, location, requirements, prizes,
    cover_image_url, organizer_name, contact_email,
    views_count, registered_teams_count, is_featured, is_published,
    created_at, updated_at
) VALUES (
    gen_random_uuid(),
    'Hackathon IA & Machine Learning 2024',
    'hackathon-ia-2024',
    'Desarrolla soluciones con Inteligencia Artificial. Proyectos ganadores implementados en empresas reales.',
    'Hackathon enfocado en IA y Machine Learning',
    'Tecnología',
    'hackathon',
    'finished',
    CURRENT_DATE - INTERVAL '90 days',
    CURRENT_DATE - INTERVAL '60 days',
    CURRENT_DATE - INTERVAL '50 days',
    CURRENT_DATE - INTERVAL '48 days',
    3, 5, 30,
    'Campus Digital',
    '["Conocimientos de ML", "Laptop con GPU", "Python"]'::jsonb,
    '["1er Lugar: $80,000 MXN", "Implementación real", "Contrato laboral"]'::jsonb,
    'https://images.unsplash.com/photo-1555255707-c07966088b7b?w=800',
    'Departamento IA',
    'ia@eventec.com',
    1245, 28, true, true,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
) ON CONFLICT (id) DO NOTHING;

-- Evento 7: Feria Emprendimiento 2024 (TERMINADO)
INSERT INTO events (
    id, title, slug, description, short_description, category, 
    event_type, status, registration_start_date, registration_end_date,
    event_start_date, event_end_date, min_team_size, max_team_size,
    max_teams, location, requirements, prizes,
    cover_image_url, organizer_name, contact_email,
    views_count, registered_teams_count, is_featured, is_published,
    created_at, updated_at
) VALUES (
    gen_random_uuid(),
    'Feria de Emprendimiento Estudiantil 2024',
    'feria-emprendimiento-2024',
    'Exposición de proyectos empresariales estudiantiles. Networking con inversionistas.',
    'Exposición de startups estudiantiles',
    'Negocios',
    'exhibition',
    'finished',
    CURRENT_DATE - INTERVAL '120 days',
    CURRENT_DATE - INTERVAL '75 days',
    CURRENT_DATE - INTERVAL '70 days',
    CURRENT_DATE - INTERVAL '69 days',
    2, 4, 40,
    'Centro Empresarial',
    '["Business plan", "Pitch deck", "Prototipo"]'::jsonb,
    '["Capital semilla", "Mentoría", "Espacio coworking gratis"]'::jsonb,
    'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800',
    'Incubadora de Negocios',
    'emprende@eventec.com',
    892, 35, false, true,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
) ON CONFLICT (id) DO NOTHING;

-- Evento 8: Olimpiada de Matemáticas (TERMINADO)
INSERT INTO events (
    id, title, slug, description, short_description, category, 
    event_type, status, registration_start_date, registration_end_date,
    event_start_date, event_end_date, min_team_size, max_team_size,
    max_teams, location, requirements, prizes,
    cover_image_url, organizer_name, contact_email,
    views_count, registered_teams_count, is_featured, is_published,
    created_at, updated_at
) VALUES (
    gen_random_uuid(),
    'Olimpiada Nacional de Matemáticas 2024',
    'olimpiada-matematicas-2024',
    'Competencia de alto nivel en matemáticas. Problemas de álgebra, geometría, teoría de números.',
    'Competencia nacional de matemáticas avanzadas',
    'Ciencias',
    'competition',
    'finished',
    CURRENT_DATE - INTERVAL '100 days',
    CURRENT_DATE - INTERVAL '65 days',
    CURRENT_DATE - INTERVAL '60 days',
    CURRENT_DATE - INTERVAL '59 days',
    1, 3, 100,
    'Universidad Nacional',
    '["Alto nivel matemático", "Calculadora científica"]'::jsonb,
    '["Medalla de oro", "Beca completa", "Viaje internacional"]'::jsonb,
    'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=800',
    'Sociedad Matemática',
    'matematicas@eventec.com',
    456, 67, true, true,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
) ON CONFLICT (id) DO NOTHING;

-- ========================================
-- ✅ RESUMEN
-- ========================================
-- Se crearon:
-- ✓ 3 eventos PRÓXIMOS (upcoming)
-- ✓ 2 eventos ACTIVOS (in_progress)  
-- ✓ 3 eventos TERMINADOS (finished)
-- 
-- Total: 8 eventos de ejemplo
-- 
-- Ahora puedes probar la vista con los 3 tabs funcionando
-- ========================================
