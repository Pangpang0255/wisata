@extends('layout')

@section('title', 'Login - Aplikasi Wisata')

@section('styles')
<style>
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        width: 100%;
        padding: 20px;
        background: linear-gradient(135deg, #55C2C3 0%, #c9d1d5 100%);
    }

    .login-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        padding: 50px 40px;
        width: 100%;
        max-width: 420px;
        animation: slideUp 0.5s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .login-header h2 {
        background: linear-gradient(#55c2c3);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 32px;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .login-header p {
        color: #718096;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2d3748;
        font-weight: 600;
        font-size: 14px;
    }

    .form-group input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        outline: none;
        border-color: #228B22;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .login-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(#55c2c3);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .login-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .icon {
        text-align: center;
        margin-bottom: 20px;
        font-size: 70px;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        animation: shake 0.5s;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }

    .alert-error {
        background: #fed7d7;
        color: #c53030;
        border-left: 4px solid #f56565;
    }

    /* Mobile Responsive */
    @media (max-width: 480px) {
        .login-container {
            padding: 10px;
            align-items: flex-start;
            padding-top: 20px;
        }

        .login-card {
            padding: 30px 20px;
            border-radius: 12px;
            max-width: none;
            margin: 0 auto;
        }

        .login-header h2 {
            font-size: 24px;
        }

        .login-header p {
            font-size: 13px;
        }

        .icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            padding: 16px 18px;
            font-size: 16px; /* Prevent zoom on iOS */
            border-radius: 8px;
        }

        .login-btn {
            padding: 16px;
            font-size: 16px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .alert {
            padding: 10px 12px;
            font-size: 13px;
            margin-bottom: 15px;
        }
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="icon">🏝️</div>
        <div class="login-header">
            <h2>Wisata Indonesia</h2>
            <p>Login Admin - Kelola Data Wisata</p>
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
