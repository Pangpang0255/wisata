<?php

header('Content-Type: application/json');

try {
    // Check if app can bootstrap
    $app = require __DIR__.'/../bootstrap/app.php';
    
    echo json_encode([
        'status' => 'healthy',
        'timestamp' => date('Y-m-d H:i:s'),
        'php_version' => PHP_VERSION
    ]);
    
    http_response_code(200);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    
    http_response_code(500);
}
