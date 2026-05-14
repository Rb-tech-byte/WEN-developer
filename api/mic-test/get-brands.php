<?php
/**
 * GET /api/mic-test/get-brands.php
 * Get all microphone brands
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'database.php';

// Demo brands
$brands = [
    ['id' => 1, 'name' => 'Shure', 'slug' => 'shure', 'count' => 2],
    ['id' => 2, 'name' => 'Rode', 'slug' => 'rode', 'count' => 1],
    ['id' => 3, 'name' => 'Audio-Technica', 'slug' => 'audio-technica', 'count' => 1],
    ['id' => 4, 'name' => 'AKG', 'slug' => 'akg', 'count' => 1],
    ['id' => 5, 'name' => 'Neumann', 'slug' => 'neumann', 'count' => 1],
    ['id' => 6, 'name' => 'Sennheiser', 'slug' => 'sennheiser', 'count' => 1],
    ['id' => 7, 'name' => 'Blue', 'slug' => 'blue', 'count' => 1],
    ['id' => 8, 'name' => 'Warm Audio', 'slug' => 'warm-audio', 'count' => 1],
    ['id' => 9, 'name' => 'Lewitt', 'slug' => 'lewitt', 'count' => 1]
];

jsonResponse([
    'success' => true,
    'data' => $brands
]);