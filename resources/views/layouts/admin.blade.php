<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduka - @yield('title', 'Obuke')</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f6f7;
        }

        /* LAYOUT */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #005c64;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        /* LOGO */
        .sidebar-header {
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo {
            font-size: 28px;
            font-weight: 900;
            font-style: italic;
        }

        /* NAV */
        .sidebar-nav {
            padding-top: 22px; 
            margin-top: 72px;  
            display: flex;
            flex-direction: column;
            gap: 22px;
            align-items: center;
        }

        .sidebar-nav a {
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            padding: 8px 28px;
            border-radius: 20px;
            transition: 0.2s;
        }

        .sidebar-nav a.active,
        .sidebar-nav a:hover {
            background: #0a8f96;
            font-weight: 600;
        }

        .sidebar-logout {
            margin-top: auto;
            text-align: center;
            padding: 20px 0;
        }

        .sidebar-logout button {
            background: none;
            border: none;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }

        /* MAIN */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        .header {
            height: 72px;
            background: #008c95;
            color: #fff;
            padding: 0 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 26px;
            font-weight: 700;
            margin: 0;
        }

        .header-user {
            font-size: 14px;
        }

        /* SUBHEADER */
        .subheader {
            background: transparent;
            padding: 26px 32px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .subheader h2 {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
            color: #005c64;
        }

        .btn-add {
            background: #008c95;
            color: #fff;
            padding: 8px 22px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-add:hover {
            background: #006f76;
            color: #fff;
        }

        /* CONTENT */
        .content {
            padding: 32px;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sidebar-header">
            <div class="sidebar-logo">Eduka</div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('obukas.index') }}"
               class="{{ request()->routeIs('obukas.*') ? 'active' : '' }}">
                Obuke
            </a>
            <a href="{{ route('tests.index') }}"
               class="{{ request()->routeIs('tests.*') ? 'active' : '' }}">
               Praćenje napretka
            </a>
            <a href="{{ route('users.index') }}"
               class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
               Korisnici
            </a>
        </nav>

        <div class="sidebar-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Odjavite se</button>
            </form>
        </div>

    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- HEADER -->
        <header class="header">
            <h1>@yield('page-title', 'Obuke')</h1>
            <div class="header-user">
                {{ auth()->user()->name }}
            </div>
        </header>

        <!-- SUBHEADER -->
        <section class="subheader">
            <h2>@yield('subheader-title')</h2>
            @yield('subheader-action')
        </section>

        <!-- CONTENT -->
        <main class="content">
            @yield('content')
        </main>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
