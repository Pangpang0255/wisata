<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test that API is working
     *
     * @return void
     */
    public function test_api_is_accessible()
    {
        // Run migrations first
        $this->artisan('migrate');
        
        // Create test data
        \App\Models\Wisata::create([
            'nama_wisata' => 'Test',
            'deskripsi' => 'Test',
            'lokasi' => 'Test',
            'harga_tiket' => 1000,
            'rating' => 4.0
        ]);
        
        $response = $this->get('/api/wisata');

        $this->assertEquals(200, $this->response->status());
    }

    /**
     * Test that API returns JSON
     *
     * @return void
     */
    public function test_api_returns_json()
    {
        $response = $this->get('/api/wisata');

        $this->seeHeader('Content-Type', 'application/json');
    }
}
