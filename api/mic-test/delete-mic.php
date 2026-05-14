<?php
/**
 * POST /api/mic-test/delete-mic.php
 * Delete a microphone
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

$id = intval($data['id']);

// In production, delete from database
jsonResponse([
    'success' => true,
    'message' => 'Microphone deleted successfully',
    'data' => [
        'id' => $id
    ]
]);