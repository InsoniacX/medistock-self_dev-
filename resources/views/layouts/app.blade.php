<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MediStock') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <link rel="stylesheet" href="https://unpkg.com/feather-icons/dist/feather.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
        });
    </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #279B48;
            --warning: #FFBD07;
            --danger: #ED1E28;
            --success: #0AC275;
            --black: #333333;
            --white: #FFFFFF;
            --light-gray: #F5F5F5;
            --dark-grey: #808080;
            --border-radius: 16px;
            --header-height: 60px;
        }

        /* Body */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Typography */
        .welcome-message {
            color: var(--primary);
            font-size: 20px;
            font-weight: 500;
        }

        .section-title {
            font-size: 20px;
            font-weight: 500;
        }

        /* Layout */
        html,
        body,
        .app-container {
            height: 100%;
        }

        .app-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-container {
            display: flex;
            flex: 1;
            position: relative;
            height: calc(100vh - var(--header-height));
        }

        /* Header */
        .app-header {
            background-color: var(--primary);
            height: var(--header-height);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            z-index: 1000;
            position: sticky;
            top: 0;
        }

        .search-input {
            width: 100%;
            padding: 8px 15px 8px 45px;
            border-radius: 50px;
            border: none;
            outline: none;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .search-input::placeholder {
            color: white;
            opacity: 0.7;
        }

        /* Sidebar Menu */
        .sidebar-container {
            width: 280px;
            height: 100%;
            padding: 1rem;
            position: sticky;
            top: var(--header-height);
            align-self: flex-start;
        }

        .menu-box {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            height: calc(100vh - var(--header-height) - 2rem);
        }

        .menu-box-content {
            padding: 20px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .app-logo {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding: 10px 0;
        }

        .logo-image {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
        }

        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 20px;
            font-weight: 500;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            margin-bottom: 15px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            color: var(--black);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 15px;
            font-weight: 500;
        }

        .menu-link:hover {
            background-color: rgba(39, 155, 72, 0.05);
            color: var(--primary);
        }

        .menu-link.active {
            background-color: var(--primary);
            color: var(--white);
        }

        .menu-icon {
            margin-right: 12px;
            width: 18px;
            height: 18px;
        }

        .menu-link:hover .menu-icon {
            filter: brightness(0) invert(41%) sepia(86%) saturate(459%) hue-rotate(93deg) brightness(94%) contrast(89%);
        }

        .menu-link.active .menu-icon {
            filter: invert(1) brightness(100);
        }

        .menu-box-footer {
            padding: 20px;
            border-top: 1px solid var(--light-gray);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            color: var(--black);
            padding: 12px 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            width: 100%;
            text-align: left;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: rgba(39, 155, 72, 0.05);
            color: var(--primary);
        }

        .logout-icon {
            width: 18px;
            height: 18px;
            margin-right: 12px;
        }

        .menu-divider {
            border-top: 1px solid var(--dark-grey);
            margin: 15px 0;
        }

        /* User Profile */
        .user-profile {
            display: flex;
            align-items: center;
            padding: 0 15px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background-color: var(--dark-grey);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 500;
            color: var(--white);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 500;
            font-size: 15px;
            color: var(--black);
        }

        .user-role {
            font-size: 13px;
            color: var(--dark-grey);
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
            height: 100%;
        }

        /* Card Styling */
        .card {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .text-total-obat {
            color: var(--success);
        }

        .text-akan-kadaluarsa {
            color: var(--warning);
        }

        .text-kadaluarsa {
            color: var(--danger);
        }

        .text-stok-menipis {
            color: var(--black);
        }

        /* Table Styling */
        .table {
            border-collapse: separate;
            border-spacing: 0 0px;
        }

        .table tbody tr td {
            border: none;
        }

        .table-header {
            background-color: var(--primary);
            color: var(--white);
        }

        .table-header th {
            padding: 12px;
            font-weight: 500;
            font-size: 16px;
        }

        .table-header th:first-child {
            border-radius: 16px 0 0 0;
        }

        .table-header th:last-child {
            border-radius: 0 16px 0 0;
        }

        .page-item:first-child .page-link {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }

        .page-item:last-child .page-link {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .page-item.disabled .page-link {
            color: var(--dark-grey);
            pointer-events: none;
            background-color: var(--white);
            border-color: var(--light-gray);
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: var(--primary);
            background-color: var(--white);
            border: 1px solid var(--light-gray);
            text-decoration: none;
        }

        .page-link:hover {
            z-index: 2;
            color: var(--primary);
            text-decoration: none;
            background-color: var(--white);
            border-color: var(--light-gray);
        }

        .page-link:focus {
            z-index: 3;
            outline: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Notification Styling */
        .icon-danger {
            filter: brightness(0) saturate(100%) invert(23%) sepia(83%) saturate(7470%) hue-rotate(356deg) brightness(91%) contrast(121%);
        }

        .icon-warning {
            filter: brightness(0) saturate(100%) invert(72%) sepia(78%) saturate(936%) hue-rotate(359deg) brightness(101%) contrast(106%);
        }

        .icon-black {
            filter: brightness(0) saturate(100%);
        }

        .bg-danger-light {
            background-color: rgba(237, 30, 40, 0.1);
        }

        .bg-warning-light {
            background-color: rgba(255, 189, 7, 0.1);
        }

        .bg-light-gray {
            background-color: var(--light-gray);
        }

        .notification-list {
            margin-bottom: 0;
        }

        .notification-item {
            padding: 10px;
            border-radius: 8px;
        }

        .table tbody tr,
        .notification-item {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover,
        .notification-item:hover {
            background-color: rgba(0, 0, 0, 0.03);
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .notification-icon {
            height: 2rem;
            width: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-message {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .notification-description {
            font-size: 14px;
            margin-bottom: 5px;
            color: var(--dark-grey);
        }

        .badge-tanggal {
            background-color: var(--dark-grey);
            font-size: 14px;
            color: var(--white);
            padding: 4px 10px;
            border-radius: 16px;
            display: inline-block;
            min-width: 120px;
            text-align: center;
        }

        .view-all-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 16px;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .view-all-link:hover {
            text-decoration: underline;
        }

        /* Status Notification */
        .status-notification {
            background-color: #d4edda;
            color: var(--primary);
            padding: 10px;
            border-radius: 5px;
            margin: 1rem;
        }

        /* Khusus untuk status notification */
        .status-container {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="app-container">
        <!-- Header -->
        <header class="app-header">
            <div style="position: relative; width: 80%; max-width: 600px;">
                <input type="text" placeholder="Looking for something?" class="search-input">
                <img src="{{ asset('assets/images/search.png') }}" alt="Search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; opacity: 0.7;">
            </div>
            <div style="margin-left: 15px;">
                <button style="background-color: rgba(255, 255, 255, 0.2); border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                    <img src="{{ asset('assets/images/bell.png') }}" alt="Notifications" style="width: 20px; height: 20px;">
                </button>
            </div>
        </header>

        <!-- Status Notification -->
        @if(session('status'))
        <div class="status-container">
            <div class="status-notification">
                {{ session('status') }}
            </div>
        </div>
        @endif

        <div class="content-container">
            <!-- Sidebar Menu -->
            <div class="sidebar-container">
                <div class="menu-box">
                    <div class="menu-box-content">
                        <!-- Logo dan Nama Website-->
                        <div class="app-logo">
                            <img src="{{ asset('assets/images/MediStock_Icon.png') }}" alt="MediStock Logo" class="logo-image">
                            <span class="logo-text">MediStock</span>
                        </div>

                        <!-- Menu Header -->
                        <div class="menu-header">
                            <span>Menu</span>
                            <button class="btn p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                        </div>

                        <ul class="sidebar-menu">
                            <li class="menu-item">
                                <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') || request()->is('*expiring-medications*') ? 'active' : '' }}">
                                    <img src="{{ asset('assets/images/dashboard.png') }}" alt="Dashboard" class="menu-icon">
                                    Dashboard
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('inventory.index') }}" class="menu-link {{ request()->routeIs('inventory.index') ? 'active' : '' }}">
                                    <img src="{{ asset('assets/images/inventories.png') }}" alt="Inventaris" class="menu-icon">
                                    Inventaris
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('manajemen.kasir') }}" class="menu-link {{ request()->routeIs('manajemen.kasir') ? 'active' : '' }}">
                                    <img src="{{ asset('assets/images/cashier-management.png') }}" alt="Manajemen Kasir" class="menu-icon">
                                    Manajemen Kasir
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('reports.monthly') }}" class="menu-link">
                                    <img src="{{ asset('assets/images/report.png') }}" alt="Laporan" class="menu-icon">
                                    Laporan
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="menu-box-footer">
                        <!-- Logout button -->
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <img src="{{ asset('assets/images/logout.png') }}" alt="Logout" class="logout-icon">
                                Log Out
                            </button>
                        </form>

                        <div class="menu-divider"></div>

                        <!-- User profile -->
                        <div class="user-profile">
                            <div class="user-avatar">
                                <span>A</span>
                            </div>
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->name ?? 'Nama Admin' }}</div>
                                <div class="user-role">({{ Auth::user()->getRoleNames()->first() ?? 'Admin' }})</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="main-content">
                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>