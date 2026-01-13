@extends('layouts.authlayout')

@section('title', 'Prijava')

@push('styles')
<!-- Poppins font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;1,900&display=swap" rel="stylesheet">

<style>
    body {
        background: #005461 !important;
        font-family: 'Poppins', sans-serif;
    }

    .login-wrapper {
        min-height: 100vh;
    }

    .login-title {
        color: #ffffff;
        font-size: 56px;
        font-weight: 900;
        font-style: italic;
        margin-bottom: 45px;
        text-align: center;
    }

    .auth-card {
        width: 380px;
        background: #018790;
        border-radius: 28px;
        padding: 32px 28px;
        color: #fff;
    }

    .auth-card h3 {
        font-weight: 700;
        margin-bottom: 6px;
    }

    .auth-subtitle {
        font-size: 13px;
        opacity: 0.9;
        margin-bottom: 22px;
    }

    .auth-label {
        text-align: left !important;
        display: block;
        padding-left: 14px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .input-wrapper {
        position: relative;
    }

    .auth-input {
        border-radius: 18px;
        height: 42px;
        font-size: 14px;
        padding-left: 14px;
        padding-right: 42px;
    }

    .input-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 16px;
        pointer-events: none;
    }

    .auth-btn {
        background: #005461;
        border: none;
        border-radius: 18px;
        padding: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #ffffff;
    }

    .auth-btn:hover {
        background: #00424d;
    }

    .text-danger {
        font-size: 12px;
    }
</style>
@endpush

@section('content')
<div class="login-wrapper d-flex flex-column justify-content-center align-items-center">

    <div class="login-title">
        Dobrodošli na Eduku
    </div>

    <div class="auth-card text-center shadow">

        <h3>Prijavite se</h3>
        <div class="auth-subtitle">
            Prijavite se koristeći email i lozinku
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-3 text-start">
                <div class="auth-label text-start">Email:</div>
                <div class="input-wrapper">
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control auth-input"
                        placeholder="Unesite email"
                        required
                        autofocus
                    >
                    <i class="bi bi-envelope input-icon"></i>
                </div>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="mb-4 text-start">
                <div class="auth-label text-start">Lozinka:</div>
                <div class="input-wrapper">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control auth-input"
                        placeholder="Unesite lozinku"
                        required
                    >
                    <i class="bi bi-lock input-icon"></i>
                </div>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn auth-btn w-100">
                Prijavite se
            </button>
        </form>

    </div>
</div>
@endsection
