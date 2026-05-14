<?php
/**
 * GET /api/mic-test/get-mics.php
 * Get all microphones with optional filtering
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Include database connection
require_once 'database.php';

// Demo data for when database is not available
$demo_mics = [
    [
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
        'thumbnail' => '/uploads/mic-tests/images/shure-sm7b.jpg',
        'featured' => 1,
        'status' => 'active'
    ],
    [
        'id' => 2,
        'name' => 'Rode NT1 5th Gen',
        'slug' => 'rode-nt1-5th-gen',
        'brand' => 'Rode',
        'mic_type' => 'Condenser',
        'price' => 279.00,
        'short_description' => 'Ultra-quiet cardioid condenser microphone',
        'full_description' => 'The Rode NT1 5th Gen is the latest iteration of Rode\'s iconic NT1 studio microphone. It features a revolutionary new capsule design, incredibly low self-noise, and premium build quality.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '10 ohms',
        'thumbnail' => '/uploads/mic-tests/images/rode-nt1.jpg',
        'featured' => 1,
        'status' => 'active'
    ],
    [
        'id' => 3,
        'name' => 'Audio-Technica AT2020',
        'slug' => 'audio-technica-at2020',
        'brand' => 'Audio-Technica',
        'mic_type' => 'Condenser',
        'price' => 149.00,
        'short_description' => 'Professional side-address condenser',
        'full_description' => 'The Audio-Technica AT2020 is a side-address condenser microphone designed for project/home studio applications. Its fixed-charge back plate helps deliver detailed audio reproduction.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '100 ohms',
        'thumbnail' => '/uploads/mic-tests/images/at2020.jpg',
        'featured' => 0,
        'status' => 'active'
    ],
    [
        'id' => 4,
        'name' => 'AKG C414 XLII',
        'slug' => 'akg-c414-xlii',
        'brand' => 'AKG',
        'mic_type' => 'Condenser',
        'price' => 1299.00,
        'short_description' => 'Legendary multipattern condenser',
        'full_description' => 'The AKG C414 XLII is one of the most versatile and used microphones in professional recording. It offers 9 pickup patterns and exceptional clarity.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => '9 polar patterns',
        'connectivity' => 'XLR',
        'impedance' => '200 ohms',
        'thumbnail' => '/uploads/mic-tests/images/akg-c414.jpg',
        'featured' => 1,
        'status' => 'active'
    ],
    [
        'id' => 5,
        'name' => 'Neumann U87 Ai',
        'slug' => 'neumann-u87-ai',
        'brand' => 'Neumann',
        'mic_type' => 'Condenser',
        'price' => 3990.00,
        'short_description' => 'The classic studio condenser microphone',
        'full_description' => 'The Neumann U87 Ai is the definitive studio microphone. Its large dual-diaphragm capsule and legendary transformer make it the choice for vocals worldwide.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => 'Omni/Cardioid/Figure-8',
        'connectivity' => 'XLR',
        'impedance' => '200 ohms',
        'thumbnail' => '/uploads/mic-tests/images/u87.jpg',
        'featured' => 1,
        'status' => 'active'
    ],
    [
        'id' => 6,
        'name' => 'Sennheiser MD 421',
        'slug' => 'sennheiser-md-421',
        'brand' => 'Sennheiser',
        'mic_type' => 'Dynamic',
        'price' => 399.00,
        'short_description' => 'Classic broadcast and recording mic',
        'full_description' => 'The Sennheiser MD 421 is a classic dynamic microphone known for its exceptional durability and voice reproduction. Often used for drums and broadcasting.',
        'frequency_response' => '40Hz - 18kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '350 ohms',
        'thumbnail' => '/uploads/mic-tests/images/md421.jpg',
        'featured' => 0,
        'status' => 'active'
    ],
    [
        'id' => 7,
        'name' => 'Blue Ember',
        'slug' => 'blue-ember',
        'brand' => 'Blue',
        'mic_type' => 'Condenser',
        'price' => 169.00,
        'short_description' => 'Professional compact condenser',
        'full_description' => 'The Blue Ember is a compact, side-address condenser microphone with a custom hand-tuned capsule for professional recording.',
        'frequency_response' => '38Hz - 20kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '16 ohms',
        'thumbnail' => '/uploads/mic-tests/images/blue-ember.jpg',
        'featured' => 0,
        'status' => 'active'
    ],
    [
        'id' => 8,
        'name' => 'Warm Audio WA-47jr',
        'slug' => 'warm-audio-wa-47jr',
        'brand' => 'Warm Audio',
        'mic_type' => 'Condenser',
        'price' => 299.00,
        'short_description' => 'Faithful reproduction of classic 47',
        'full_description' => 'The Warm Audio WA-47jr is a compact, transformer-less reproduction of the classic U47. It delivers that warm, vintage tone at an affordable price.',
        'frequency_response' => '20Hz - 20kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '100 ohms',
        'thumbnail' => '/uploads/mic-tests/images/wa47jr.jpg',
        'featured' => 0,
        'status' => 'active'
    ],
    [
        'id' => 9,
        'name' => 'Lewitt MTP 550 DM',
        'slug' => 'lewitt-mtp-550-dm',
        'brand' => 'Lewitt',
        'mic_type' => 'Dynamic',
        'price' => 259.00,
        'short_description' => 'Compact handheld dynamic microphone',
        'full_description' => 'The Lewitt MTP 550 DM is a compact dynamic handheld microphone with a precise cardioid polar pattern, designed for live performances and studio work.',
        'frequency_response' => '60Hz - 16kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '300 ohms',
        'thumbnail' => '/uploads/mic-tests/images/lewitt.jpg',
        'featured' => 0,
        'status' => 'active'
    ],
    [
        'id' => 10,
        'name' => 'Shure SM58',
        'slug' => 'shure-sm58',
        'brand' => 'Shure',
        'mic_type' => 'Dynamic',
        'price' => 99.00,
        'short_description' => 'Industry standard live vocal mic',
        'full_description' => 'The Shure SM58 is the world\'s most popular live vocal microphone. Its quality and durability make it a staple in live sound.',
        'frequency_response' => '50Hz - 15kHz',
        'polar_pattern' => 'Cardioid',
        'connectivity' => 'XLR',
        'impedance' => '300 ohms',
        'thumbnail' => '/uploads/mic-tests/images/sm58.jpg',
        'featured' => 0,
        'status' =>
        'active'
    ]
];

// Get filter parameters
$brand = isset($_GET['brand']) ? $_GET['brand'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;
$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : null;
$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : null;
$featured = isset($_GET['featured']) ? $_GET['featured'] : null;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 12;

// Apply filters to demo data
$filtered_mics = $demo_mics;

if ($brand) {
    $filtered_mics = array_filter($filtered_mics, function($mic) use ($brand) {
        return strtolower($mic['brand']) === strtolower($brand);
    });
}

if ($type) {
    $filtered_mics = array_filter($filtered_mics, function($mic) use ($type) {
        return strtolower($mic['mic_type']) === strtolower($type);
    });
}

if ($search) {
    $search_lower = strtolower($search);
    $filtered_mics = array_filter($filtered_mics, function($mic) use ($search_lower) {
        return strpos(strtolower($mic['name']), $search_lower) !== false ||
               strpos(strtolower($mic['brand']), $search_lower) !== false ||
               strpos(strtolower($mic['short_description']), $search_lower) !== false;
    });
}

if ($min_price !== null) {
    $filtered_mics = array_filter($filtered_mics, function($mic) use ($min_price) {
        return $mic['price'] >= $min_price;
    });
}

if ($max_price !== null) {
    $filtered_mics = array_filter($filtered_mics, function($mic) use ($max_price) {
        return $mic['price'] <= $max_price;
    });
}

if ($featured === '1') {
    $filtered_mics = array_filter($filtered_mics, function($mic) {
        return $mic['featured'] === 1;
    });
}

// Paginate
$total = count($filtered_mics);
$filtered_mics = array_values($filtered_mics);
$start = ($page - 1) * $limit;
$paged_mics = array_slice($filtered_mics, $start, $limit);

// Get brands and types for filters
$brands = array_values(array_unique(array_column($demo_mics, 'brand')));
$types = array_values(array_unique(array_column($demo_mics, 'mic_type')));

// Response
$response = [
    'success' => true,
    'data' => $paged_mics,
    'pagination' => [
        'page' => $page,
        'limit' => $limit,
        'total' => $total,
        'total_pages' => ceil($total / $limit)
    ],
    'filters' => [
        'brands' => $brands,
        'types' => $types
    ]
];

echo json_encode($response);