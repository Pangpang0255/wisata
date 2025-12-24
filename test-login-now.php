<?php
require 'bootstrap/app.php';

echo "Testing Login...\n\n";

// Test login
$client = new GuzzleHttp\Client(['http_errors' => false]);

try {
    $response = $client->post('http://127.0.0.1:8000/api/login', [
        'json' => [
            'email' => 'admin@gmail.com',
            'password' => 'admin'
        ],
        'headers' => [
            'Accept' => 'application/json'
        ]
    ]);
    
    echo "Status: " . $response->getStatusCode() . "\n";
    echo "Response: " . $response->getBody() . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
