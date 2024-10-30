@extends('layouts/blankLayout')

@section('title', 'Halaman Login')

@section('page-style')
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
    <style>
        /* Custom Login Styles */
        body {
            background: linear-gradient(135deg, #6A82FB, #FC5C7D);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0;
            margin: 0;
        }

        .login-card {
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            background: #fff;
            padding: 2rem;
            text-align: center;
        }

        .login-header {
            font-size: 1.75rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }

        .login-subtext {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 2rem;
        }

        .form-control-custom {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .form-control-custom::placeholder {
            color: #aaa;
        }

        .form-control-custom:focus {
            border-color: #6A82FB;
            box-shadow: none;
        }

        .btn-login {
            background-color: #6A82FB;
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background-color: #5A6DE4;
        }

        .app-brand-logo img {
            width: 50px;
        }

        .app-brand-text {
            font-size: 1.5rem;
            color: #6A82FB;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="login-card">
        <!-- Title -->
        <h4 class="login-header mt-4">Selamat Datang!</h4>
        <p class="login-subtext">Silahkan masukkan username dan password anda untuk melakukan login</p>

        <!-- Login Form -->
        <form id="formAuthentication" action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control form-control-custom" id="username" name="username"
                    placeholder="Username" required autofocus>
            </div>
            <div class="mb-4">
                <input type="password" class="form-control form-control-custom" id="password" name="password"
                    placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-login w-100">Log In</button>
        </form>
        <!-- /Login Form -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Aksi Dihentikan',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endsection
