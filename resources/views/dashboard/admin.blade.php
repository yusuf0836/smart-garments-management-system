@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('sidebar-menu')
    <div class="nav-section-title">Main Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <div class="nav-section-title">Management</div>
    <a href="#" class="nav-link">
        <i class="bi bi-people"></i> Employees
    </a>
    <a href="#" class="nav-link">
        <i class="bi bi-box-seam"></i> Inventory
    </a>
    <a href="#" class="nav-link">
        <i class="bi bi-clipboard-check"></i> Orders
    </a>
    <a href="#" class="nav-link">
        <i class="bi bi-diagram-3"></i> Production
    </a>

    <div class="nav-section-title">Reports</div>
    <a href="#" class="nav-link">
        <i class="bi bi-bar-chart"></i> Analytics
    </a>
    <a href="#" class="nav-link">
        <i class="bi bi-gear"></i> Settings
    </a>
@endsection

@section('content')

{{-- Welcome --}}
<div class="mb-4">
    <h4 class="fw-bold" style="color:#1F3864;">
        Welcome back, {{ Auth::user()->name }}! 👋
    </h4>
    <p class="text-muted">Here's what's happening in your factory today.</p>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe;">
                <i class="bi bi-people-fill" style="color:#2563eb;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">Total Employees</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7;">
                <i class="bi bi-box-seam-fill" style="color:#16a34a;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">Inventory Items</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef9c3;">
                <i class="bi bi-clipboard-check-fill" style="color:#ca8a04;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">Active Orders</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fce7f3;">
                <i class="bi bi-graph-up-arrow" style="color:#db2777;"></i>
            </div>
            <div>
                <div class="stat-value">0%</div>
                <p class="stat-label">Production Efficiency</p>
            </div>
        </div>
    </div>
</div>

{{-- Chart + Recent Activity --}}
<div class="row g-3">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="content-card-header">
                <h6><i class="bi bi-bar-chart-fill me-2" style="color:#2E75B6;"></i>Production Overview</h6>
                <span class="badge" style="background:#dbeafe; color:#2563eb;">This Month</span>
            </div>
            <div class="content-card-body">
                <canvas id="productionChart" height="280"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="content-card">
            <div class="content-card-header">
                <h6><i class="bi bi-activity me-2" style="color:#2E75B6;"></i>Recent Activity</h6>
            </div>
            <div class="content-card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4 py-3">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:8px;height:8px;background:#16a34a;border-radius:50%;flex-shrink:0;"></div>
                            <div>
                                <div style="font-size:13px;font-weight:600;">System Ready</div>
                                <div style="font-size:11px;color:#888;">Just now</div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-4 py-3">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:8px;height:8px;background:#2563eb;border-radius:50%;flex-shrink:0;"></div>
                            <div>
                                <div style="font-size:13px;font-weight:600;">Admin logged in</div>
                                <div style="font-size:11px;color:#888;">{{ now()->format('h:i A') }}</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('productionChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Units Produced',
                data: [0, 0, 0, 0, 0, 0],
                backgroundColor: 'rgba(46, 117, 182, 0.7)',
                borderColor: '#2E75B6',
                borderWidth: 2,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush