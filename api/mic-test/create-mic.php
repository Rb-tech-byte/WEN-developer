<?php
/**
 * POST /api/mic-test/create-mic.php
 * Create a new microphone
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'database.php';

// Get JSON input
$data = getJsonInput();

// Validate required fields
$required = ['name', 'slug', 'brand', 'mic_type', 'price'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        jsonResponse([
            'success' => false,
            'error' => "Field '$field' is required"
        ], 400);
    }
}

// Sanitize input
$sanitized = [
    'name' => sanitize($data['name']),
    'slug' => sanitize($data['slug']),
    'brand' => sanitize($data['brand']),
    'mic_type' => sanitize($data['mic_type']),
    'price' => floatval($data['price']),
    'short_description' => sanitize($data['short_description'] ?? ''),
    'full_description' => sanitize($data['full_description'] ?? ''),
    'frequency_response' => sanitize($data['frequency_response'] ?? ''),
    'polar_pattern' => sanitize($data['polar_pattern'] ?? ''),
    'connectivity' => sanitize($data['connectivity'] ?? ''),
    'impedance' => sanitize($data['impedance'] ?? ''),
    'external_url' => sanitize($data['external_url'] ?? ''),
    'thumbnail' => sanitize($data['thumbnail'] ?? ''),
    'featured' => isset($data['featured']) ? intval($data['featured']) : 0,
    'status' => sanitize($data['status'] ?? 'active')
];

// In production, insert into database
// For demo, return success with mock ID
$mock_id = rand(100, 999);

jsonResponse([
    'success' => true,
    'message' => 'Microphone created successfully',
    'data' => [
        'id' => $mock_id,
        'name' => $sanitized['name'],
        'slug' => $sanitized['slug']
    ]
], 201);