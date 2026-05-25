<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FleetSync – @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --accent:       #1a56db;
            --accent-light: #eff4ff;
            --success:      #0f7b55;
            --success-bg:   #ecfdf5;
            --warn:         #92400e;
            --warn-bg:      #fffbeb;
            --danger:       #991b1b;
            --danger-bg:    #fef2f2;
            --border:       rgba(0,0,0,0.07);
            --muted:        #6b7280;
            --text:         #1a1c21;
            --surface:      #ffffff;
            --bg:           #f4f5f7;
            --mono:         'JetBrains Mono', monospace;
            --font:         'Outfit', sans-serif;
            --radius:       10px;
            --radius-lg:    14px;
        }

        body {
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 220px;
            background: #111827;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 200;
            transition: transform 0.25s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 18px 20px 14px;
            border-bottom: 0.5px solid rgba(255,255,255,0.06);
            text-decoration: none;
        }

        .brand-icon {
            width: 32px; height: 32px;
            background: var(--accent);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }

        .brand-name { font-size: 13px; font-weight: 600; color: #fff; }
        .brand-sub  { font-size: 10px; color: rgba(255,255,255,0.35); text-transform: uppercase; letter-spacing: 0.04em; }

        .nav-body {
            flex: 1;
            padding: 16px 12px 8px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 400;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            transition: all 0.15s;
        }

        .nav-item i { font-size: 17px; flex-shrink: 0; }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
        .nav-item.active { background: var(--accent); color: #fff; font-weight: 500; }

        .nav-badge {
            margin-left: auto;
            background: #ef4444;
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            padding: 1px 6px;
            border-radius: 20px;
        }

        .sidebar-footer {
            padding: 12px;
            border-top: 0.5px solid rgba(255,255,255,0.06);
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .footer-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 10px;
            border-radius: 8px;
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            transition: all 0.15s;
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
            font-family: var(--font);
        }

        .footer-item i { font-size: 17px; flex-shrink: 0; }
        .footer-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
        .footer-item.logout:hover { background: rgba(239,68,68,0.15); color: #f87171; }

        .divider { height: 0.5px; background: rgba(255,255,255,0.06); margin: 4px 0; }

        /* ── OVERLAY (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 199;
        }

        .sidebar-overlay.active { display: block; }

        /* ── MAIN ── */
        .main-wrap {
            margin-left: 220px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            height: 56px;
            background: var(--surface);
            border-bottom: 0.5px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 12px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .page-title { font-size: 15px; font-weight: 600; flex: 1; }

        /* hamburger — hidden on desktop */
        .hamburger {
            display: none;
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 0.5px solid var(--border);
            background: transparent;
            align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--muted);
            font-size: 18px;
            flex-shrink: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            font-family: var(--font);
            cursor: pointer;
            border: none;
            text-decoration: none;
        }

        .btn-primary { background: var(--accent); color: #fff; }
        .btn-ghost   { background: transparent; border: 0.5px solid var(--border); color: var(--muted); }

        .icon-btn {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 0.5px solid var(--border);
            background: transparent;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: var(--muted);
            font-size: 16px;
            position: relative;
        }

        .notif-dot {
            position: absolute;
            top: 5px; right: 5px;
            width: 6px; height: 6px;
            background: #ef4444;
            border-radius: 50%;
            border: 1.5px solid var(--surface);
        }

        .font-control {
            display: flex;
            align-items: center;
            border: 0.5px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
        }

        .font-btn {
            padding: 5px 10px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-family: var(--font);
            font-weight: 600;
            color: var(--muted);
            transition: background 0.15s;
            line-height: 1;
        }

        .font-btn:hover { background: var(--bg); color: var(--text); }
        .font-btn.plus  { font-size: 14px; }
        .font-btn.minus { font-size: 11px; }

        .font-divider {
            width: 0.5px;
            height: 20px;
            background: var(--border);
        }

        .content { padding: 24px; flex: 1; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: var(--surface);
            border: 0.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 18px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .stat-header { display: flex; align-items: center; justify-content: space-between; }
        .stat-label  { font-size: 12px; color: var(--muted); font-weight: 500; }

        .stat-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
        }

        .stat-icon.blue  { background: var(--accent-light); color: var(--accent); }
        .stat-icon.green { background: var(--success-bg);   color: var(--success); }
        .stat-icon.amber { background: var(--warn-bg);       color: #b45309; }
        .stat-icon.red   { background: var(--danger-bg);     color: var(--danger); }

        .stat-value {
            font-size: 30px;
            font-weight: 600;
            font-family: var(--mono);
            letter-spacing: -0.02em;
            line-height: 1;
        }

        .stat-footer { display: flex; align-items: center; gap: 5px; font-size: 11.5px; }
        .trend       { font-weight: 500; font-family: var(--mono); }
        .trend.up    { color: var(--success); }
        .trend.down  { color: #dc2626; }
        .trend-label { color: var(--muted); }

        .two-col { display: grid; grid-template-columns: 1fr 300px; gap: 16px; }

        .card {
            background: var(--surface);
            border: 0.5px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px 0;
        }

        .card-title  { font-size: 13.5px; font-weight: 600; }
        .card-action { font-size: 12px; color: var(--accent); font-weight: 500; text-decoration: none; }

        .table-wrap { padding: 10px 18px 16px; }

        table { width: 100%; border-collapse: collapse; }

        th {
            font-size: 10.5px;
            font-weight: 500;
            color: var(--muted);
            text-align: left;
            padding: 8px 0 6px;
            border-bottom: 0.5px solid var(--border);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        td {
            font-size: 12.5px;
            padding: 10px 0;
            border-bottom: 0.5px solid var(--border);
        }

        tr:last-child td { border-bottom: none; }

        .vehicle-name { font-weight: 500; }
        .plate { font-family: var(--mono); font-size: 11px; color: var(--muted); margin-top: 1px; }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge.green { background: var(--success-bg); color: var(--success); }
        .badge.amber { background: var(--warn-bg);    color: var(--warn); }
        .badge.red   { background: var(--danger-bg);  color: var(--danger); }
        .badge.blue  { background: var(--accent-light); color: var(--accent); }

        .alerts-list { padding: 6px 18px 16px; }

        .alert-item {
            display: flex;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 0.5px solid var(--border);
        }

        .alert-item:last-child { border-bottom: none; }

        .alert-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; margin-top: 4px; }
        .alert-dot.red   { background: #ef4444; }
        .alert-dot.amber { background: #f59e0b; }
        .alert-dot.blue  { background: var(--accent); }

        .alert-text { font-size: 12.5px; font-weight: 500; line-height: 1.4; }
        .alert-meta { font-size: 11.5px; color: var(--muted); margin-top: 2px; }

        .fleet-wrap { padding: 14px 18px 18px; display: flex; flex-direction: column; gap: 10px; }

        .fleet-row { display: flex; align-items: center; gap: 10px; font-size: 12.5px; }
        .fleet-label { min-width: 60px; }
        .fleet-bar-bg { flex: 1; height: 6px; background: var(--bg); border-radius: 4px; overflow: hidden; }
        .fleet-bar { height: 100%; border-radius: 4px; }
        .fleet-count { font-family: var(--mono); font-size: 11px; color: var(--muted); min-width: 24px; text-align: right; }

        /* ── MOBILE RESPONSIVE ── */
        @media (max-width: 768px) {

            body { display: block; }

            /* sidebar slides off-screen by default */
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            /* no left margin on mobile */
            .main-wrap {
                margin-left: 0;
            }

            /* show hamburger */
            .hamburger {
                display: flex;
            }

            /* topbar padding tighter */
            .topbar {
                padding: 0 16px;
            }

            /* hide font controls on mobile to save space */
            .font-control {
                display: none;
            }

            /* content padding smaller */
            .content {
                padding: 16px;
            }

            /* stats: 2 columns on mobile */
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            /* two-col stack to single column */
            .two-col {
                grid-template-columns: 1fr;
            }

            /* tables scroll horizontally */
            .table-wrap {
                overflow-x: auto;
                padding: 10px 12px 16px;
            }

            table {
                min-width: 480px;
            }

            .stat-card {
                padding: 14px;
            }

            .stat-value {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            /* stats: 1 column on very small phones */
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- overlay behind sidebar on mobile -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<nav class="sidebar" id="sidebar">
    <a href="{{ route('dashboard') }}" class="brand">
        <div class="brand-icon">
            <i class="ti ti-car" style="color:#fff;font-size:17px"></i>
        </div>
        <div>
            <div class="brand-name">FleetSync</div>
            <div class="brand-sub">Portal</div>
        </div>
    </a>

    <div class="nav-body">
        <a href="{{ route('dashboard') }}"
           class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="ti ti-layout-dashboard"></i> Dashboard
        </a>

        <a href="{{ route('vehicles.index') }}"
           class="nav-item {{ request()->routeIs('vehicles.*') ? 'active' : '' }}">
            <i class="ti ti-car"></i> Vehicles
        </a>

        <a href="{{ route('maintenance.index') }}"
           class="nav-item {{ request()->routeIs('maintenance.*') ? 'active' : '' }}">
            <i class="ti ti-tools"></i> Maintenance
            @php $pendingCount = \App\Models\Maintenance::where('status','pending')->count(); @endphp
            @if($pendingCount > 0)
                <span class="nav-badge">{{ $pendingCount }}</span>
            @endif
        </a>

        @if(auth()->user()->role === 'admin')
        <a href="{{ route('reports.index') }}"
           class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="ti ti-chart-bar"></i> Reports
        </a>
        @endif

        <a href="{{ route('profile') }}"
           class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="ti ti-user-circle"></i> My Account
            <span style="margin-left:auto;font-size:10px;background:rgba(255,255,255,0.1);padding:2px 7px;border-radius:10px;color:rgba(255,255,255,0.5);">
                {{ ucfirst(auth()->user()->role) }}
            </span>
        </a>
    </div>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="footer-item logout">
                <i class="ti ti-logout"></i> Logout
            </button>
        </form>
    </div>
</nav>

<div class="main-wrap">
    <header class="topbar">
        <!-- hamburger (mobile only) -->
        <button class="hamburger" onclick="openSidebar()" aria-label="Open menu">
            <i class="ti ti-menu-2"></i>
        </button>

        <div class="page-title">@yield('title', 'Dashboard')</div>

        <div style="display:flex;align-items:center;gap:8px;">
            <div class="font-control">
                <button class="font-btn plus" onclick="changeFontSize(1)" title="Increase font size">A+</button>
                <div class="font-divider"></div>
                <button class="font-btn minus" onclick="changeFontSize(-1)" title="Decrease font size">A−</button>
            </div>
            <div class="icon-btn">
                <i class="ti ti-bell"></i>
                <div class="notif-dot"></div>
            </div>
            @yield('topbar-actions')
        </div>
    </header>

    <div class="content">
        @if(session('success'))
            <div style="background:var(--success-bg);color:var(--success);border:0.5px solid var(--success);padding:10px 16px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')

<script>
    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('sidebarOverlay').classList.add('active');
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('active');
    }

    let currentFontSize = 13;
    function changeFontSize(delta) {
        currentFontSize = Math.min(18, Math.max(10, currentFontSize + delta));
        document.querySelectorAll('td, th, .stat-label, .stat-value, .alert-text, .alert-meta, .card-title, .fleet-row, .vehicle-name, .plate, .badge')
            .forEach(el => el.style.fontSize = currentFontSize + 'px');
    }
</script>

</body>
</html>