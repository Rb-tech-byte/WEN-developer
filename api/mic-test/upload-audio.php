<?php
/**
 * POST /api/mic-test/upload-audio.php
 * Upload audio file for microphone test
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'database.php';

// Check if file was uploaded
if (!isset($_FILES['audio_file'])) {
    jsonResponse([
        'success' => false,
        'error' => 'No audio file uploaded'
    ], 400);
}

$file = $_FILES['audio_file'];
$mic_id = isset($_POST['mic_id']) ? intval($_POST['mic_id']) : null;
$test_type = isset($_POST['test_type']) ? sanitize($_POST['test_type']) : null;
$label = isset($_POST['label']) ? sanitize($_POST['label']) : '';

// Validate
if (!$mic_id) {
    jsonResponse([
        'success' => false,
        'error' => 'Microphone ID is required'
    ], 400);
}

if (!$test_type) {
    jsonResponse([
        'success' => false,
        'error' => 'Test type is required'
    ], 400);
}

// Allowed extensions
$allowed = ['mp3', 'wav', 'ogg', 'm4a', 'aac'];
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    jsonResponse([
        'success' => false,
        'error' => 'Invalid file type. Allowed: ' . implode(', ', $allowed)
    ], 400);
}

// Check for upload errors
if ($file['error'] !== UPLOAD_ERR_OK) {
    jsonResponse([
        'success' => false,
        'error' => 'File upload error: ' . $file['error']
    ], 400);
}

// Upload directory
$upload_dir = __DIR__ . '/../../uploads/mic-tests/audio/';

// Create directory if not exists
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Generate unique filename
$filename = $mic_id . '_' . $test_type . '_' . time() . '.' . $ext;
$filepath = $upload_dir . $filename;

// Move uploaded file
if (move_uploaded_file($file['tmp_name'], $filepath)) {
    // In production, save to database
    $file_url = '/uploads/mic-tests/audio/' . $filename;
    
    jsonResponse([
        'success' => true,
        'message' => 'Audio uploaded successfully',
        'data' => [
            'file_path' => $file_url,
            'mic_id' => $mic_id,
            'test_type' => $test_type,
            'label' => $label
        ]
    ]);
} else {
    jsonResponse([
        'success' => false,
        'error' => 'Failed to move uploaded file'
    ], 500);
}