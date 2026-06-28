@extends('layouts.app')
@section('title', 'Manager Dashboard')
@section('page-title', 'Manager Dashboard')

@section('sidebar-menu')
    <div class="nav-section-title">Main Menu</div>
    <a href="{{ route('manager.dashboard') }}" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <div class="nav-section-title">Management</div>
    <a href="#" class="nav-link"><i class="bi bi-people"></i> Employees</a>
    <a href="#" class="nav-link"><i class="bi bi-clipboard-check"></i> Orders</a>
    <a href="#" class="nav-link"><i class="bi bi-diagram-3"></i> Production</a>
@endsection

@section('content')
<div class="mb-4">
    <h4 class="fw-bold" style="color:#1F3864;">Welcome, {{ Auth::user()->name }}! 👋</h4>
    <p class="text-muted">Manage your department operations.</p>
</div>
<div class="row g-3">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe;">
                <i class="bi bi-clipboard-check-fill" style="color:#2563eb;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">Active Orders</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7;">
                <i class="bi bi-people-fill" style="color:#16a34a;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">Team Members</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef9c3;">
                <i class="bi bi-graph-up" style="color:#ca8a04;"></i>
            </div>
            <div>
                <div class="stat-value">0%</div>
                <p class="stat-label">Efficiency</p>
            </div>
        </div>
    </div>
</div>
@endsection