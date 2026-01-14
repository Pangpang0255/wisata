#!/usr/bin/env php
<?php

/**
 * Test Runner Script with Beautiful Output
 * 
 * This script runs PHPUnit tests and displays results in a beautiful format
 */

echo "\033[1;36m";
echo "╔═══════════════════════════════════════════════════════════════╗\n";
echo "║                                                               ║\n";
echo "║           🧪 WISATA API - UNIT TEST RUNNER 🧪                ║\n";
echo "║                                                               ║\n";
echo "╚═══════════════════════════════════════════════════════════════╝\n";
echo "\033[0m\n";

// Check if vendor directory exists
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    echo "\033[1;31m❌ Error: Vendor directory not found!\033[0m\n";
    echo "Please run: composer install\n";
    exit(1);
}

// Set environment to testing
putenv('APP_ENV=testing');

echo "\033[1;33m📋 Preparing test environment...\033[0m\n\n";

// Check for test database configuration
if (!file_exists(__DIR__ . '/.env.testing')) {
    echo "\033[1;33m⚠️  Warning: .env.testing not found, using default test config\033[0m\n\n";
}

echo "\033[1;32m🚀 Running tests...\033[0m\n";
echo str_repeat("─", 63) . "\n\n";

// Run PHPUnit
$command = __DIR__ . '/vendor/bin/phpunit --colors=always --testdox';

// Execute the command
passthru($command, $exitCode);

echo "\n" . str_repeat("─", 63) . "\n";

if ($exitCode === 0) {
    echo "\033[1;32m";
    echo "╔═══════════════════════════════════════════════════════════════╗\n";
    echo "║                                                               ║\n";
    echo "║                  ✅ ALL TESTS PASSED! ✅                     ║\n";
    echo "║                                                               ║\n";
    echo "╚═══════════════════════════════════════════════════════════════╝\n";
    echo "\033[0m";
} else {
    echo "\033[1;31m";
    echo "╔═══════════════════════════════════════════════════════════════╗\n";
    echo "║                                                               ║\n";
    echo "║                   ❌ SOME TESTS FAILED ❌                    ║\n";
    echo "║                                                               ║\n";
    echo "╚═══════════════════════════════════════════════════════════════╝\n";
    echo "\033[0m";
}

echo "\n\033[1;36m📊 Test Summary:\033[0m\n";
echo "  • Run time: " . date('Y-m-d H:i:s') . "\n";
echo "  • Exit code: " . $exitCode . "\n\n";

exit($exitCode);
