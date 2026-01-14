<?php
/**
 * Test Runner API
 * Backend untuk menjalankan PHPUnit tests dan return JSON response
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Check if PHPUnit exists
if (!file_exists(__DIR__ . '/../vendor/bin/phpunit')) {
    echo json_encode([
        'success' => false,
        'error' => 'PHPUnit not found. Please run: composer install',
        'output' => '',
        'total' => 0,
        'passed' => 0,
        'failed' => 0
    ]);
    exit;
}

// Get filter parameter
$filter = $_GET['filter'] ?? '';

// Change to project root directory
$projectRoot = dirname(__DIR__);
chdir($projectRoot);

// Build command - use relative path from project root
$command = "php vendor/bin/phpunit --testdox --colors=never";

if (!empty($filter)) {
    $command .= " --filter " . escapeshellarg($filter);
}

$command .= " 2>&1"; // Capture stderr too

// Set environment to testing
putenv('APP_ENV=testing');
putenv('APP_KEY=base64:TEST_KEY_FOR_TESTING_ONLY');
putenv('JWT_SECRET=TEST_JWT_SECRET_FOR_TESTING_ONLY');

// Execute tests
$output = [];
$returnCode = 0;
exec($command, $output, $returnCode);

// Parse output
$outputString = implode("\n", $output);

// If output contains usage/help, there was an error
if (strpos($outputString, 'Usage:') !== false || empty($outputString)) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to run tests. Please check PHPUnit configuration.',
        'output' => 'Error: Unable to execute PHPUnit properly.\n\nCommand: ' . $command . '\n\nOutput:\n' . $outputString,
        'total' => 0,
        'passed' => 0,
        'failed' => 0,
        'returnCode' => $returnCode
    ]);
    exit;
}

// Count tests
$total = 0;
$passed = 0;
$failed = 0;

// Parse test results - try multiple patterns
if (preg_match('/Tests: (\d+)/', $outputString, $matches)) {
    $total = (int)$matches[1];
} elseif (preg_match('/OK \((\d+) test/', $outputString, $matches)) {
    $total = (int)$matches[1];
    $passed = $total;
}

if (preg_match('/Failures: (\d+)/', $outputString, $matches)) {
    $failed += (int)$matches[1];
}

if (preg_match('/Errors: (\d+)/', $outputString, $matches)) {
    $failed += (int)$matches[1];
}

// If we have total and failed, calculate passed
if ($total > 0) {
    $passed = $total - $failed;
}

// Format output for display
$formattedOutput = $outputString;

// Color output for terminal (will be displayed in HTML)
$formattedOutput = str_replace('[32m', '<span style="color: #38ef7d;">', $formattedOutput);
$formattedOutput = str_replace('[31m', '<span style="color: #f5576c;">', $formattedOutput);
$formattedOutput = str_replace('[33m', '<span style="color: #ffd93d;">', $formattedOutput);
$formattedOutput = str_replace('[0m', '</span>', $formattedOutput);

// Clean ANSI codes
$formattedOutput = preg_replace('/\033\[[0-9;]+m/', '', $formattedOutput);

// Build response
$response = [
    'success' => $returnCode === 0,
    'output' => $formattedOutput,
    'total' => $total,
    'passed' => $passed,
    'failed' => $failed,
    'returnCode' => $returnCode,
    'timestamp' => date('Y-m-d H:i:s')
];

echo json_encode($response, JSON_PRETTY_PRINT);
