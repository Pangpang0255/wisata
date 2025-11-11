@extends('layout')

@section('title', 'Login - Aplikasi Wisata')

@section('styles')
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .login-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        padding: 40px;
        width: 100%;
        max-width: 400px;
    }

    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-header h2 {
        color: #667eea;
        font-size: 32px;
        margin-bottom: 10px;
    }

    .login-header p {
        color: #718096;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2d3748;
        font-weight: 500;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus {
        outline: none;
        border-color: #667eea;
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
    }

    .login-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .icon {
        text-align: center;
        margin-bottom: 20px;
        font-size: 60px;
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="icon">🏝️</div>
        <div class="login-header">
            <h2>Wisata Indonesia</h2>
            <p>Silakan login untuk melanjutkan</p>
        </div>

        <div id="error-message"></div>

        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="admin@wisata.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="login-btn" id="loginBtn">
                Masuk
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const API_URL = window.location.origin + '/api';

    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const loginBtn = document.getElementById('loginBtn');
        const errorMessage = document.getElementById('error-message');

        // Clear previous errors
        errorMessage.innerHTML = '';
        loginBtn.disabled = true;
        loginBtn.textContent = 'Memproses...';

        try {
            const response = await fetch(API_URL + '/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            });

            const data = await response.json();

            if (response.ok && data.access_token) {
                // Save token to localStorage
                localStorage.setItem('token', data.access_token);
                localStorage.setItem('user', JSON.stringify(data.user || { email: email }));
                
                // Redirect to dashboard
                window.location.href = '/dashboard';
            } else {
                throw new Error(data.error || 'Login gagal. Silakan coba lagi.');
            }
        } catch (error) {
            errorMessage.innerHTML = `
                <div class="alert alert-error">
                    ${error.message}
                </div>
            `;
        } finally {
            loginBtn.disabled = false;
            loginBtn.textContent = 'Masuk';
        }
    });

    // Check if already logged in
    if (localStorage.getItem('token')) {
        window.location.href = '/dashboard';
    }
</script>
@endsection
