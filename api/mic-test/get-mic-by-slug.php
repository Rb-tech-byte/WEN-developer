<?php
/**
 * GET /api/mic-test/get-mic-by-slug.php
 * Get single microphone by slug
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'database.php';

// Get slug from query parameter
$slug = isset($_GET['slug']) ? sanitize($_GET['slug']) : null;

if (!$slug) {
    jsonResponse([
        'success' => false,
        'error' => 'Microphone slug is required'
    ], 400);
}

// Demo data - same as get-mic.php
$demo_mics = [
    'shure-sm7b' => [
        'id' => 1,
        'name' => 'Shure SM7B',
        'slug' => 'shure-sm7b',
        'brand' => 'Shure',
        'mic_type' => 'Dynamic',
        'price' => 399.00,
        'short_description' => 'The industry standard for broadcast and podcasting',
        'full_description' => 'The Shure SM7B is a legendary microphone that has been the go-to choice for professional broadcasters, podcasters, and voice-over artists for decades. Its smooth, flat, wide-range frequency response accommodates both music and speech, and includes a bass rolloff and presence boost controls.',
        'frequency_response' => '50Hz - 20kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '310 ohms',
        'external_url' => 'https://www.shure.com/en-US/products/microphones/sm7b',
        'thumbnail' => '/uploads/mic-tests/images/shure-sm7b.jpg',
        'images' => [
            '/uploads/mic-tests/images/shure-sm7b.jpg'
        ],
        'audio_tests' => [
            ['id' => 1, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/shure-sm7b-male.mp3', 'duration' => 15.0],
            ['id' => 2, 'test_type' => 'female_voice', 'label' => 'Female Voice Test', 'file' => '/uploads/mic-tests/audio/shure-sm7b-female.mp3', 'duration' => 15.0],
            ['id' => 3, 'test_type' => 'podcast', 'label' => 'Podcast Test', 'file' => '/uploads/mic-tests/audio/shure-sm7b-podcast.mp3', 'duration' => 20.0],
            ['id' => 4, 'test_type' => 'guitar', 'label' => 'Acoustic Guitar', 'file' => '/uploads/mic-tests/audio/shure-sm7b-guitar.mp3', 'duration' => 10.0],
            ['id' => 5, 'test_type' => 'drum', 'label' => 'Drum Overhead', 'file' => '/uploads/mic-tests/audio/shure-sm7b-drum.mp3', 'duration' => 8.0]
        ],
        'featured' => 1,
        'status' => 'active'
    ],
    'rode-nt1-5th-gen' => [
        'id' => 2,
        'name' => 'Rode NT1 5th Gen',
        'slug' => 'rode-nt1-5th-gen',
        'brand' => 'Rode',
        'mic_type' => 'Condenser',
        'price' => 279.00,
        'short_description' => 'Ultra-quiet cardioid condenser microphone',
        'full_description' => 'The Rode NT1 5th Gen is the latest iteration of Rode\'s iconic NT1 studio microphone.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '10 ohms',
        'external_url' => 'https://rode.com/microphones/nt1',
        'thumbnail' => '/uploads/mic-tests/images/rode-nt1.jpg',
        'images' => [
            '/uploads/mic-tests/images/rode-nt1.jpg'
        ],
        'audio_tests' => [
            ['id' => 6, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/rode-nt1-male.mp3', 'duration' => 15.0],
            ['id' => 7, 'test_type' => 'female_voice', 'label' => 'Female Voice Test', 'file' => '/uploads/mic-tests/audio/rode-nt1-female.mp3', 'duration' => 15.0],
            ['id' => 8, 'test_type' => 'podcast', 'label' => 'Podcast Test', 'file' => '/uploads/mic-tests/audio/rode-nt1-podcast.mp3', 'duration' => 20.0],
            ['id' => 9, 'test_type' => 'guitar', 'label' => 'Acoustic Guitar', 'file' => '/uploads/mic-tests/audio/rode-nt1-guitar.mp3', 'duration' => 10.0],
            ['id' => 10, 'test_type' => 'drum', 'label' => 'Drum Overhead', 'file' => '/uploads/mic-tests/audio/rode-nt1-drum.mp3', 'duration' => 8.0]
        ],
        'featured' => 1,
        'status' => 'active'
    ],
    'audio-technica-at2020' => [
        'id' => 3,
        'name' => 'Audio-Technica AT2020',
        'slug' => 'audio-technica-at2020',
        'brand' => 'Audio-Technica',
        'mic_type' => 'Condenser',
        'price' => 149.00,
        'short_description' => 'Professional side-address condenser',
        'full_description' => 'The Audio-Technica AT2020 is a side-address condenser microphone designed for project/home studio applications.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '100 ohms',
        'external_url' => 'https://www.audio-technica.com/at2020',
        'thumbnail' => '/uploads/mic-tests/images/at2020.jpg',
        'images' => [
            '/uploads/mic-tests/images/at2020.jpg'
        ],
        'audio_tests' => [
            ['id' => 11, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/at2020-male.mp3', 'duration' => 15.0],
            ['id' => 12, 'test_type' => 'female_voice', 'label' => 'Female Voice Test', 'file' => '/uploads/mic-tests/audio/at2020-female.mp3', 'duration' => 15.0]
        ],
        'featured' => 0,
        'status' => 'active'
    ],
    'akg-c414-xlii' => [
        'id' => 4,
        'name' => 'AKG C414 XLII',
        'slug' => 'akg-c414-xlii',
        'brand' => 'AKG',
        'mic_type' => 'Condenser',
        'price' => 1299.00,
        'short_description' => 'Legendary multipattern condenser',
        'full_description' => 'The AKG C414 XLII is one of the most versatile and used microphones in professional recording.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => '9 polar patterns',
        'connectivity' => 'XLR',
        'impedance' => '200 ohms',
        'external_url' => 'https://www.akg.com/c414',
        'thumbnail' => '/uploads/mic-tests/images/akg-c414.jpg',
        'images' => [
            '/uploads/mic-tests/images/akg-c414.jpg'
        ],
        'audio_tests' => [
            ['id' => 13, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/akg-c414-male.mp3', 'duration' => 15.0],
            ['id' => 14, 'test_type' => 'female_voice', 'label' => 'Female Voice Test', 'file' => '/uploads/mic-tests/audio/akg-c414-female.mp3', 'duration' => 15.0]
        ],
        'featured' => 1,
        'status' => 'active'
    ],
    'neumann-u87-ai' => [
        'id' => 5,
        'name' => 'Neumann U87 Ai',
        'slug' => 'neumann-u87-ai',
        'brand' => 'Neumann',
        'mic_type' => 'Condenser',
        'price' => 3990.00,
        'short_description' => 'The classic studio condenser microphone',
        'full_description' => 'The Neumann U87 Ai is the definitive studio microphone.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => 'Omni/Cardioid/Figure-8',
        'connectivity' => 'XLR',
        'impedance' => '200 ohms',
        'external_url' => 'https://www.neumann.com/u87-ai',
        'thumbnail' => '/uploads/mic-tests/images/u87.jpg',
        'images' => [
            '/uploads/mic-tests/images/u87.jpg'
        ],
        'audio_tests' => [
            ['id' => 15, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/u87-male.mp3', 'duration' => 15.0],
            ['id' => 16, 'test_type' => 'female_voice', 'label' => 'Female Voice Test', 'file' => '/uploads/mic-tests/audio/u87-female.mp3', 'duration' => 15.0]
        ],
        'featured' => 1,
        'status' => 'active'
    ],
    'sennheiser-md-421' => [
        'id' => 6,
        'name' => 'Sennheiser MD 421',
        'slug' => 'sennheiser-md-421',
        'brand' => 'Sennheiser',
        'mic_type' => 'Dynamic',
        'price' => 399.00,
        'short_description' => 'Classic broadcast and recording mic',
        'full_description' => 'The Sennheiser MD 421 is a classic dynamic microphone known for its exceptional durability.',
        'frequency_response' => '40Hz - 18kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '350 ohms',
        'external_url' => 'https://en-us.sennheiser.com/md-421',
        'thumbnail' => '/uploads/mic-tests/images/md421.jpg',
        'images' => [
            '/uploads/mic-tests/images/md421.jpg'
        ],
        'audio_tests' => [
            ['id' => 17, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/md421-male.mp3', 'duration' => 15.0]
        ],
        'featured' => 0,
        'status' => 'active'
    ],
    'blue-ember' => [
        'id' => 7,
        'name' => 'Blue Ember',
        'slug' => 'blue-ember',
        'brand' => 'Blue',
        'mic_type' => 'Condenser',
        'price' => 169.00,
        'short_description' => 'Professional compact condenser',
        'full_description' => 'The Blue Ember is a compact, side-address condenser microphone with a custom hand-tuned capsule.',
        'frequency_response' => '38Hz - 20kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '16 ohms',
        'external_url' => 'https://www.bluemic.com/ember',
        'thumbnail' => '/uploads/mic-tests/images/blue-ember.jpg',
        'images' => [
            '/uploads/mic-tests/images/blue-ember.jpg'
        ],
        'audio_tests' => [
            ['id' => 18, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/blue-ember-male.mp3', 'duration' => 15.0]
        ],
        'featured' => 0,
        'status' => 'active'
    ],
    'warm-audio-wa-47jr' => [
        'id' => 8,
        'name' => 'Warm Audio WA-47jr',
        'slug' => 'warm-audio-wa-47jr',
        'brand' => 'Warm Audio',
        'mic_type' => 'Condenser',
        'price' => 299.00,
        'short_description' => 'Faithful reproduction of classic 47',
        'full_description' => 'The Warm Audio WA-47jr is a compact, transformer-less reproduction of the classic U47.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '100 ohms',
        'external_url' => 'https://warmaudio.com/wa-47jr',
        'thumbnail' => '/uploads/mic-tests/images/wa47jr.jpg',
        'images' => [
            '/uploads/mic-tests/images/wa47jr.jpg'
        ],
        'audio_tests' => [
            ['id' => 19, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/wa47jr-male.mp3', 'duration' => 15.0]
        ],
        'featured' => 0,
        'status' => 'active'
    ],
    'lewitt-mtp-550-dm' => [
        'id' => 9,
        'name' => 'Lewitt MTP 550 DM',
        'slug' => 'lewitt-mtp-550-dm',
        'brand' => 'Lewitt',
        'mic_type' => 'Dynamic',
        'price' => 259.00,
        'short_description' => 'Compact handheld dynamic microphone',
        'full_description' => 'The Lewitt MTP 550 DM is a compact dynamic handheld microphone with a precise cardioid polar pattern.',
        'frequency_response' => '60Hz - 16kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '300 ohms',
        'external_url' => 'https://www.lewitt-audio.com/mtp-550-dm',
        'thumbnail' => '/uploads/mic-tests/images/lewitt.jpg',
        'images' => [
            '/uploads/mic-tests/images/lewitt.jpg'
        ],
        'audio_tests' => [
            ['id' => 20, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/lewitt-male.mp3', 'duration' => 15.0]
        ],
        'featured' => 0,
        'status' => 'active'
    ],
    'shure-sm58' => [
        'id' => 10,
        'name' => 'Shure SM58',
        'slug' => 'shure-sm58',
        'brand' => 'Shure',
        'mic_type' => 'Dynamic',
        'price' => 99.00,
        'short_description' => 'Industry standard live vocal mic',
        'full_description' => 'The Shure SM58 is the world\'s most popular live vocal microphone.',
        'frequency_response' => '50Hz - 15kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '300 ohms',
        'external_url' => 'https://www.shure.com/sm58',
        'thumbnail' => '/uploads/mic-tests/images/sm58.jpg',
        'images' => [
            '/uploads/mic-tests/images/sm58.jpg'
        ],
        'audio_tests' => [
            ['id' => 21, 'test_type' => 'male_voice', 'label' => 'Male Voice Test', 'file' => '/uploads/mic-tests/audio/sm58-male.mp3', 'duration' => 15.0]
        ],
        'featured' => 0,
        'status' => 'active'
    ]
];

if (isset($demo_mics[$slug])) {
    jsonResponse([
        'success' => true,
        'data' => $demo_mics[$slug]
    ]);
} else {
    jsonResponse([
        'success' => false,
        'error' => 'Microphone not found'
    ], 404);
}