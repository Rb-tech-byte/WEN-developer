<?php
/**
 * POST /api/mic-test/update-mic.php
 * Update an existing microphone
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'database.php';

// Get JSON input
$data = getJsonInput();

// Validate required fields
if (empty($data['id'])) {
    jsonResponse([
        'success' => false,
        'error' => 'Microphone ID is required'
    ], 400);
}

// Sanitize input
$sanitized = [
    'id' => intval($data['id']),
    'name' => sanitize($data['name'] ?? ''),
    'slug' => sanitize($data['slug'] ?? ''),
    'brand' => sanitize($data['brand'] ?? ''),
    'mic_type' => sanitize($data['mic_type'] ?? ''),
    'price' => isset($data['price']) ? floatval($data['price']) : null,
    'short_description' => sanitize($data['short_description'] ?? ''),
    'full_description' => sanitize($data['full_description'] ?? ''),
    'frequency_response' => sanitize($data['frequency_response'] ?? ''),
    'polar_pattern' => sanitize($data['polar_pattern'] ?? ''),
    'connectivity' => sanitize($data['connectivity'] ?? ''),
    'impedance' => sanitize($data['impedance'] ?? ''),
    'external_url' => sanitize($data['external_url'] ?? ''),
    'thumbnail' => sanitize($data['thumbnail'] ?? ''),
    'featured' => isset($data['featured']) ? intval($data['featured']) : null,
    'status' => sanitize($data['status'] ?? '')
];

// In production, update database
jsonResponse([
    'success' => true,
    'message' => 'Microphone updated successfully',
    'data' => [
        'id' => $sanitized['id']
    ]
]);