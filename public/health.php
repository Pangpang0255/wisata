<?php

header('Content-Type: application/json');

$checks = [
    'app' => false,
    'database' => false,
    'jwt' => false,
    'env' => false
];

$errors = [];

try {
    // Check if app can bootstrap
    $app = require __DIR__.'/../bootstrap/app.php';
    $checks['app'] = true;
    
    // Check environment variables
    $requiredEnv = ['APP_KEY', 'DB_HOST', 'DB_DATABASE', 'JWT_SECRET'];
    $missingEnv = [];
    
    foreach ($requiredEnv as $env) {
        if (!env($env)) {
            $missingEnv[] = $env;
        }
    }
    
    if (empty($missingEnv)) {
        $checks['env'] = true;
    } else {
        $errors[] = 'Missing environment variables: ' . implode(', ', $missingEnv);
    }
    
    // Check JWT secret
    if (env('JWT_SECRET')) {
        $checks['jwt'] = true;
    } else {
        $errors[] = 'JWT_SECRET not configured';
    }
    
    // Check database connection
    try {
        $pdo = new PDO(
            'mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        );
        $checks['database'] = true;
    } catch (PDOException $e) {
        $errors[] = 'Database connection failed: ' . $e->getMessage();
    }
    
    $allHealthy = !in_array(false, $checks);
    
    echo json_encode([
        'status' => $allHealthy ? 'healthy' : 'unhealthy',
        'checks' => $checks,
        'errors' => $errors,
        'timestamp' => date('Y-m-d H:i:s'),
        'php_version' => PHP_VERSION
    ]);
    
    http_response_code($allHealthy ? 200 : 500);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    
    http_response_code(500);
}
