<?php
/**
 * Database Connection for AK23 Studio Kits
 * Mic Test Lab API
 */

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        // Database configuration - update these values for your environment
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->db_name = getenv('DB_NAME') ?: 'ak23_studio_kits';
        $this->username = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASS') ?: '';
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $exception) {
            $response = [
                'success' => false,
                'error' => 'Database connection failed',
                'message' => $exception->getMessage()
            ];
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        return $this->conn;
    }

    public function getConnectionForAPI() {
        // For development/demo - use SQLite in-memory if MySQL not available
        try {
            return $this->getConnection();
        } catch (Exception $e) {
            // Return null to indicate no database - UI will use demo data
            return null;
        }
    }
}

// Helper function to send JSON response
function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    echo json_encode($data);
    exit;
}

// Helper function to get JSON input
function getJsonInput() {
    $input = file_get_contents('php://input');
    return json_decode($input, true) ?? [];
}

// Helper function to sanitize input
function sanitize($value) {
    if (is_array($value)) {
        return array_map('sanitize', $value);
    }
    return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
}