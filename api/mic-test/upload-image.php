<?php
/**
 * POST /api/mic-test/upload-image.php
 * Upload image for microphone
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'database.php';

// Check if file was uploaded
if (!isset($_FILES['image_file'])) {
    jsonResponse([
        'success' => false,
        'error' => 'No image file uploaded'
    ], 400);
}

$file = $_FILES['image_file'];
$mic_id = isset($_POST['mic_id']) ? intval($_POST['mic_id']) : null;
$label = isset($_POST['label']) ? sanitize($_POST['label']) : 'Main';

// Allowed extensions
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
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
$upload_dir = __DIR__ . '/../../uploads/mic-tests/images/';

// Create directory if not exists
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Generate unique filename
$filename = 'mic_' . $mic_id . '_' . time() . '.' . $ext;
$filepath = $upload_dir . $filename;

// Move uploaded file
if (move_uploaded_file($file['tmp_name'], $filepath)) {
    // In production, save to database
    $file_url = '/uploads/mic-tests/images/' . $filename;
    
    jsonResponse([
        'success' => true,
        'message' => 'Image uploaded successfully',
        'data' => [
            'file_path' => $file_url,
            'mic_id' => $mic_id,
            'label' => $label
        ]
    ]);
} else {
    jsonResponse([
        'success' => false,
        'error' => 'Failed to move uploaded file'
    ], 500);
}