<?php
// Diagnostic endpoint - minimal dependencies
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$diagnostics = [
    'status' => 'checking',
    'php_version' => PHP_VERSION,
    'timestamp' => date('Y-m-d H:i:s'),
    'environment' => []
];

// Check critical environment variables
$envVars = [
    'APP_KEY',
    'APP_ENV', 
    'APP_DEBUG',
    'DB_HOST',
    'DB_PORT',
    'DB_DATABASE',
    'DB_USERNAME',
    'DB_PASSWORD',
    'JWT_SECRET'
];

foreach ($envVars as $var) {
    $value = getenv($var);
    $diagnostics['environment'][$var] = $value ? 'SET' : 'NOT SET';
}

// Check if .env file exists
$diagnostics['env_file_exists'] = file_exists(__DIR__ . '/../.env');

// Check if vendor exists
$diagnostics['vendor_exists'] = is_dir(__DIR__ . '/../vendor');

// Check if bootstrap/app.php exists
$diagnostics['bootstrap_exists'] = file_exists(__DIR__ . '/../bootstrap/app.php');

// Check writable directories
$diagnostics['storage_writable'] = is_writable(__DIR__ . '/../storage');
$diagnostics['cache_writable'] = is_writable(__DIR__ . '/../bootstrap/cache');

// Try to load autoloader
try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $diagnostics['autoload'] = 'OK';
} catch (Exception $e) {
    $diagnostics['autoload'] = 'FAILED: ' . $e->getMessage();
}

// Count missing critical env vars
$missing = array_filter($diagnostics['environment'], function($v) {
    return $v === 'NOT SET';
});

if (count($missing) > 0) {
    $diagnostics['status'] = 'unhealthy';
    $diagnostics['message'] = 'Missing environment variables: ' . implode(', ', array_keys($missing));
} else {
    $diagnostics['status'] = 'healthy';
    $diagnostics['message'] = 'All checks passed';
}

echo json_encode($diagnostics, JSON_PRETTY_PRINT);
