<?php
/**
 * GET /api/mic-test/get-types.php
 * Get all microphone types
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'database.php';

// Demo types
$types = [
    ['id' => 1, 'name' => 'Dynamic', 'slug' => 'dynamic', 'description' => 'Dynamic microphones are rugged and can handle high sound pressure levels.', 'count' => 4],
    ['id' => 2, 'name' => 'Condenser', 'slug' => 'condenser', 'description' => 'Condenser microphones offer superior sensitivity and detail.', 'count' => 6],
    ['id' => 3, 'name' => 'USB', 'slug' => 'usb', 'description' => 'USB microphones connect directly to computers for digital recording.', 'count' => 0],
    ['id' => 4, 'name' => 'Ribbon', 'slug' => 'ribbon', 'description' => 'Ribbon microphones offer warm, natural sound reproduction.', 'count' => 0],
    ['id' => 5, 'name' => 'Lavalier', 'slug' => 'lavalier', 'description' => 'Small clip-on microphones for hands-free recording.', 'count' => 0]
];

jsonResponse([
    'success' => true,
    'data' => $types
]);