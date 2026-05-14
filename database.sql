-- Mic Test Lab Database Schema
-- AK23 Studio Kits

-- =====================================================
-- TABLE: mic_tests (Main microphones table)
-- =====================================================

CREATE TABLE IF NOT EXISTS mic_tests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    brand VARCHAR(100) NOT NULL,
    mic_type VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) DEFAULT 0.00,
    short_description TEXT,
    full_description TEXT,
    frequency_response VARCHAR(100),
    polar_pattern VARCHAR(100),
    connectivity VARCHAR(100),
    impedance VARCHAR(50),
    external_url VARCHAR(500),
    thumbnail VARCHAR(500),
    featured TINYINT(1) DEFAULT 0,
    status VARCHAR(20) DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_brand (brand),
    INDEX idx_type (mic_type),
    INDEX idx_featured (featured),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: mic_test_media (Gallery images)
-- =====================================================

CREATE TABLE IF NOT EXISTS mic_test_media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mic_id INT NOT NULL,
    media_type VARCHAR(20) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    label VARCHAR(100),
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (mic_id) REFERENCES mic_tests(id) ON DELETE CASCADE,
    INDEX idx_mic_id (mic_id),
    INDEX idx_media_type (media_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: mic_audio_tests (Audio test recordings)
-- =====================================================

CREATE TABLE IF NOT EXISTS mic_audio_tests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mic_id INT NOT NULL,
    test_type VARCHAR(50) NOT NULL,
    audio_file VARCHAR(500) NOT NULL,
    waveform_json TEXT,
    duration DECIMAL(6, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (mic_id) REFERENCES mic_tests(id) ON DELETE CASCADE,
    INDEX idx_mic_id (mic_id),
    INDEX idx_test_type (test_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: mic_brands (Brand definitions)
-- =====================================================

CREATE TABLE IF NOT EXISTS mic_brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    slug VARCHAR(100) NOT NULL UNIQUE,
    logo VARCHAR(500),
    website VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: mic_types (Microphone types)
-- =====================================================

CREATE TABLE IF NOT EXISTS mic_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    slug VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    icon VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Seed Data: Brands
-- =====================================================

INSERT INTO mic_brands (name, slug) VALUES 
('Shure', 'shure'),
('Rode', 'rode'),
('Audio-Technica', 'audio-technica'),
('AKG', 'akg'),
('Neumann', 'neumann'),
('Sennheiser', 'sennheiser'),
('Blue', 'blue'),
('AKG', 'akg'),
('Warm Audio', 'warm-audio'),
('Lewitt', 'lewitt');

-- =====================================================
-- Seed Data: Types
-- =====================================================

INSERT INTO mic_types (name, slug, description) VALUES 
('Dynamic', 'dynamic', 'Dynamic microphones are rugged and can handle high sound pressure levels.'),
('Condenser', 'condenser', 'Condenser microphones offer superior sensitivity and detail.'),
('USB', 'usb', 'USB microphones connect directly to computers for digital recording.'),
('Ribbon', 'ribbon', 'Ribbon microphones offer warm, natural sound reproduction.'),
('Lavalier', 'lavalier', 'Small clip-on microphones for hands-free recording.');

-- =====================================================
-- Seed Data: Microphones
-- =====================================================

INSERT INTO mic_tests (name, slug, brand, mic_type, price, short_description, full_description, frequency_response, polar_pattern, connectivity, impedance, status) VALUES 
('Shure SM7B', 'shure-sm7b', 'Shure', 'Dynamic', 399.00, 'The industry standard for broadcast and podcasting', 'The Shure SM7B is a legendary microphone that has been the go-to choice for professional broadcasters, podcasters, and voice-over artists for decades. Its smooth, flat, wide-range frequency response accommodates both music and speech, and includes a bass rolloff and presence boost controls.', '50Hz - 20kHz', 'Cardioid', 'XLR', 310, 'active'),
('Rode NT1 5th Gen', 'rode-nt1-5th-gen', 'Rode', 'Condenser', 279.00, 'Ultra-quiet cardioid condenser microphone', 'The Rode NT1 5th Gen is the latest iteration of Rode''s iconic NT1 studio microphone. It features a revolutionary new capsule design, incredibly low self-noise, and premium build quality.', '20Hz - 20kHz', 'Cardioid', 'XLR', 10, 'active'),
('Audio-Technica AT2020', 'audio-technica-at2020', 'Audio-Technica', 'Condenser', 149.00, 'Professional side-address condenser', 'The Audio-Technica AT2020 is a side-address电容 microphone designed for project/home studio applications. Its fixed-charge back plate helps deliver detailed audio reproduction.', '20Hz - 20kHz', 'Cardioid', 'XLR', 100, 'active'),
('AKG C414 XLII', 'akg-c414-xlii', 'AKG', 'Condenser', 1299.00, ' legendary multipattern condenser', 'The AKG C414 XLII is one of the most versatile and used microphones in professional recording. It offers 9 pickup patterns and exceptional clarity.', '20Hz - 20kHz', '9 polar patterns', 'XLR', 200, 'active'),
('Neumann U87 Ai', 'neumann-u87-ai', 'Neumann', 'Condenser', 3990.00, 'The classic studio condenser microphone', 'The Neumann U87 Ai is the definitive studio microphone. Its large dual-diaphragm capsule and legendary transformer make it the choice for vocals worldwide.', '20Hz - 20kHz', 'Omni/Cardioid/Figure-8', 'XLR', 200, 'active'),
('Sennheiser MD 421', 'sennheiser-md-421', 'Sennheiser', 'Dynamic', 399.00, 'Classic broadcast and recording mic', 'The Sennheiser MD 421 is a classic dynamic microphone known for its exceptional durability and voice reproduction. Often used for drums and broadcasting.', '40Hz - 18kHz', 'Cardioid', 'XLR', 350, 'active'),
('Blue Ember', 'blue-ember', 'Blue', 'Condenser', 169.00, 'Professionalcompact condenser', 'The Blue Ember is a compact, side-address condenser microphone with a custom hand-tuned capsule for professional recording.', '38Hz - 20kHz', 'Cardioid', 'XLR', 16, 'active'),
('Warm Audio WA-47jr', 'warm-audio-wa-47jr', 'Warm Audio', 'Condenser', 299.00, 'Faithful reproduction of classic 47', 'The Warm Audio WA-47jr is a compact, transformer-less reproduction of the classic U47. It delivers that warm, vintage tone at an affordable price.', '20Hz - 20kHz', 'Cardioid', 'XLR', 100, 'active'),
('Lewitt MTP 550 DM', 'lewitt-mtp-550-dm', 'Lewitt', 'Dynamic', 259.00, 'Compact handheld dynamic microphone', 'The Lewitt MTP 550 DM is a compact dynamic handheld microphone with a precise cardioid polar pattern, designed for live performances and studio work.', '60Hz - 16kHz', 'Cardioid', 'XLR', 300, 'active'),
('Shure SM58', 'shure-sm58', 'Shure', 'Dynamic', 99.00, 'Industry standard live vocal mic', 'The Shure SM58 is the world''s most popular live vocal microphone. Its quality and durability make it a staple in live sound.', '50Hz - 15kHz', 'Cardioid', 'XLR', 300, 'active');

-- =====================================================
-- Sample Audio Tests (Placeholders - in production these would be actual audio files)
-- =====================================================

INSERT INTO mic_audio_tests (mic_id, test_type, audio_file, waveform_json, duration) VALUES 
(1, 'male_voice', 'shure-sm7b-male.wav', '[{"time":0,"amplitude":0.2},{"time":1,"amplitude":0.4},{"time":2,"amplitude":0.6}]', 15.00),
(1, 'female_voice', 'shure-sm7b-female.wav', '[{"time":0,"amplitude":0.2},{"time":1,"amplitude":0.5},{"time":2,"amplitude":0.7}]', 15.00),
(1, 'podcast', 'shure-sm7b-podcast.wav', '[{"time":0,"amplitude":0.3},{"time":1,"amplitude":0.4},{"time":2,"amplitude":0.5}]', 20.00),
(1, 'guitar', 'shure-sm7b-guitar.wav', '[{"time":0,"amplitude":0.4},{"time":1,"amplitude":0.5},{"time":2,"amplitude":0.6}]', 10.00),
(1, 'drum', 'shure-sm7b-drum.wav', '[{"time":0,"amplitude":0.5},{"time":1,"amplitude":0.7},{"time":2,"amplitude":0.9}]', 8.00),
(2, 'male_voice', 'rode-nt1-male.wav', '[{"time":0,"amplitude":0.3},{"time":1,"amplitude":0.5},{"time":2,"amplitude":0.7}]', 15.00),
(2, 'female_voice', 'rode-nt1-female.wav', '[{"time":0,"amplitude":0.3},{"time":1,"amplitude":0.6},{"time":2,"amplitude":0.8}]', 15.00),
(2, 'podcast', 'rode-nt1-podcast.wav', '[{"time":0,"amplitude":0.4},{"time":1,"amplitude":0.5},{"time":2,"amplitude":0.6}]', 20.00),
(2, 'guitar', 'rode-nt1-guitar.wav', '[{"time":0,"amplitude":0.5},{"time":1,"amplitude":0.6},{"time":2,"amplitude":0.7}]', 10.00),
(2, 'drum', 'rode-nt1-drum.wav', '[{"time":0,"amplitude":0.6},{"time":1,"amplitude":0.8},{"time":2,"amplitude":0.9}]', 8.00),
(3, 'male_voice', 'at2020-male.wav', '[{"time":0,"amplitude":0.2},{"time":1,"amplitude":0.4},{"time":2,"amplitude":0.6}]', 15.00),
(3, 'female_voice', 'at2020-female.wav', '[{"time":0,"amplitude":0.2},{"time":1,"amplitude":0.5},{"time":2,"amplitude":0.7}]', 15.00),
(4, 'male_voice', 'akg-c414-male.wav', '[{"time":0,"amplitude":0.3},{"time":1,"amplitude":0.5},{"time":2,"amplitude":0.7}]', 15.00),
(4, 'female_voice', 'akg-c414-female.wav', '[{"time":0,"amplitude":0.3},{"time":1,"amplitude":0.6},{"time":2,"amplitude":0.8}]', 15.00),
(5, 'male_voice', 'u87-male.wav', '[{"time":0,"amplitude":0.4},{"time":1,"amplitude":0.6},{"time":2,"amplitude":0.8}]', 15.00),
(5, 'female_voice', 'u87-female.wav', '[{"time":0,"amplitude":0.4},{"time":1,"amplitude":0.7},{"time":2,"amplitude":0.9}]', 15.00),
(6, 'male_voice', 'md421-male.wav', '[{"time":0,"amplitude":0.2},{"time":1,"amplitude":0.4},{"time":2,"amplitude":0.5}]', 15.00),
(7, 'male_voice', 'blue-ember-male.wav', '[{"time":0,"amplitude":0.3},{"time":1,"amplitude":0.5},{"time":2,"amplitude":0.7}]', 15.00),
(8, 'male_voice', 'wa47jr-male.wav', '[{"time":0,"amplitude":0.3},{"time":1,"amplitude":0.5},{"time":2,"amplitude":0.7}]', 15.00),
(9, 'male_voice', 'lewitt-male.wav', '[{"time":0,"amplitude":0.2},{"time":1,"amplitude":0.4},{"time":2,"amplitude":0.5}]', 15.00),
(10, 'male_voice', 'sm58-male.wav', '[{"time":0,"amplitude":0.2},{"time":1,"amplitude":0.3},{"time":2,"amplitude":0.4}]', 15.00);

-- =====================================================
-- Sample Media (Placeholder thumbnails)
-- =====================================================

INSERT INTO mic_test_media (mic_id, media_type, file_path, label, sort_order) VALUES 
(1, 'image', '/uploads/mic-tests/images/shure-sm7b.jpg', 'Main', 1),
(2, 'image', '/uploads/mic-tests/images/rode-nt1.jpg', 'Main', 1),
(3, 'image', '/uploads/mic-tests/images/at2020.jpg', 'Main', 1),
(4, 'image', '/uploads/mic-tests/images/akg-c414.jpg', 'Main', 1),
(5, 'image', '/uploads/mic-tests/images/u87.jpg', 'Main', 1),
(6, 'image', '/uploads/mic-tests/images/md421.jpg', 'Main', 1),
(7, 'image', '/uploads/mic-tests/images/blue-ember.jpg', 'Main', 1),
(8, 'image', '/uploads/mic-tests/images/wa47jr.jpg', 'Main', 1),
(9, 'image', '/uploads/mic-tests/images/lewitt.jpg', 'Main', 1),
(10, 'image', '/uploads/mic-tests/images/sm58.jpg', 'Main', 1);