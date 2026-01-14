<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    protected $testUser;

    /**
     * Setup test database with sample user
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Run migrations
        $this->artisan('migrate');
        
        // Create test user directly
        $this->testUser = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@admin.com',
            'password' => app('hash')->make('admin'),
            'role' => 'admin'
        ]);
    }

    /**
     * Test login with valid credentials
     *
     * @return void
     */
    public function test_login_with_valid_credentials()
    {
        $response = $this->post('/api/login', [
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);

        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /**
     * Test login with invalid credentials
     *
     * @return void
     */
    public function test_login_with_invalid_credentials()
    {
        $response = $this->post('/api/login', [
            'email' => 'wrong@email.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertResponseStatus(401);
        $response->seeJson([
            'message' => 'Unauthorized'
        ]);
    }

    /**
     * Test login without email
     *
     * @return void
     */
    public function test_login_without_email()
    {
        $response = $this->post('/api/login', [
            'password' => 'admin'
        ]);

        $response->assertResponseStatus(422);
    }

    /**
     * Test login without password
     *
     * @return void
     */
    public function test_login_without_password()
    {
        $response = $this->post('/api/login', [
            'email' => 'admin@admin.com'
        ]);

        $response->assertResponseStatus(422);
    }

    /**
     * Test get user profile with valid token
     *
     * @return void
     */
    public function test_get_user_profile_with_valid_token()
    {
        // Login first to get token
        $loginResponse = $this->post('/api/login', [
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);

        $token = json_decode($loginResponse->response->getContent())->access_token;

        // Get user profile
        $response = $this->post('/api/user-profile', [], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'id',
            'name',
            'email',
            'role'
        ]);
    }

    /**
     * Test get user profile without token
     *
     * @return void
     */
    public function test_get_user_profile_without_token()
    {
        $response = $this->post('/api/user-profile');

        $response->assertResponseStatus(401);
    }

    /**
     * Test refresh token
     *
     * @return void
     */
    public function test_refresh_token()
    {
        // Login first to get token
        $loginResponse = $this->post('/api/login', [
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);

        $token = json_decode($loginResponse->response->getContent())->access_token;

        // Refresh token
        $response = $this->post('/api/refresh', [], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /**
     * Test logout
     *
     * @return void
     */
    public function test_logout()
    {
        // Login first to get token
        $loginResponse = $this->post('/api/login', [
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);

        $token = json_decode($loginResponse->response->getContent())->access_token;

        // Logout
        $response = $this->post('/api/logout', [], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertResponseStatus(200);
        $response->seeJson([
            'message' => 'Successfully logged out'
        ]);
    }
}
