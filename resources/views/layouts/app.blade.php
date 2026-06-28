<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Garments Management System')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }

        /* ── Sidebar ── */
        #sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1F3864 0%, #2E75B6 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand h5 {
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            margin: 0;
            line-height: 1.4;
        }

        .sidebar-brand p {
            color: rgba(255,255,255,0.6);
            font-size: 11px;
            margin: 2px 0 0;
        }

        .sidebar-brand .brand-icon {
            width: 42px; height: 42px;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; color: #fff;
            margin-bottom: 12px;
        }

        .sidebar-nav { padding: 16px 0; flex: 1; }

        .nav-section-title {
            font-size: 10px;
            font-weight: 700;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 12px 20px 6px;
        }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.75);
            padding: 10px 20px;
            border-radius: 0;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border-left-color: #fff;
        }

        .sidebar-nav .nav-link i { font-size: 16px; width: 20px; }

        .sidebar-user {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 16px;
            flex-shrink: 0;
        }

        .user-info .name { color: #fff; font-size: 13px; font-weight: 600; }
        .user-info .role-badge {
            font-size: 10px;
            background: rgba(255,255,255,0.2);
            color: #fff;
            padding: 1px 8px;
            border-radius: 20px;
            display: inline-block;
            text-transform: capitalize;
        }

        /* ── Main Content ── */
        #main-content {
            margin-left: 260px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* ── Topbar ── */
        .topbar {
            background: #fff;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        #sidebarToggle {
            background: none;
            border: none;
            font-size: 20px;
            color: #555;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
        }

        #sidebarToggle:hover { background: #f0f2f5; }

        .page-title { font-size: 16px; font-weight: 600; color: #1F3864; margin: 0; }

        .topbar-right { display: flex; align-items: center; gap: 8px; }

        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-logout:hover { background: #b02a37; }

        /* ── Page Content ── */
        .page-content { padding: 24px; }

        /* ── Cards ── */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s;
        }

        .stat-card:hover { transform: translateY(-2px); }

        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .stat-card .stat-value { font-size: 24px; font-weight: 700; color: #1F3864; }
        .stat-card .stat-label { font-size: 13px; color: #888; margin: 0; }

        .content-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .content-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .content-card-header h6 {
            font-weight: 700;
            color: #1F3864;
            margin: 0;
            font-size: 15px;
        }

        .content-card-body { padding: 20px; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            #sidebar { left: -260px; }
            #sidebar.show { left: 0; }
            #main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- ── Sidebar ── --}}
<div id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-building"></i></div>
        <h5>Smart Garments</h5>
        <p>Management System</p>
    </div>

    <nav class="sidebar-nav">
        @yield('sidebar-menu')
    </nav>

    <div class="sidebar-user">
        <div class="user-avatar"><i class="bi bi-person"></i></div>
        <div class="user-info">
            <div class="name">{{ Auth::user()->name }}</div>
            <span class="role-badge">{{ Auth::user()->role }}</span>
        </div>
    </div>
</div>

{{-- ── Main Content ── --}}
<div id="main-content">

    {{-- Topbar --}}
    <div class="topbar">
        <div class="topbar-left">
            <button id="sidebarToggle" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <h6 class="page-title">@yield('page-title', 'Dashboard')</h6>
        </div>
        <div class="topbar-right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    {{-- Page Content --}}
    <div class="page-content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
        } else {
            if (sidebar.style.width === '70px') {
                sidebar.style.width = '260px';
                main.style.marginLeft = '260px';
            } else {
                sidebar.style.width = '70px';
                main.style.marginLeft = '70px';
            }
        }
    }
</script>
@stack('scripts')
</body>
</html>