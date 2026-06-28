@extends('layouts.app')
@section('title', 'Buyer Dashboard')
@section('page-title', 'Buyer Dashboard')

@section('sidebar-menu')
    <div class="nav-section-title">My Menu</div>
    <a href="{{ route('buyer.dashboard') }}" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="#" class="nav-link"><i class="bi bi-bag-check"></i> My Orders</a>
    <a href="#" class="nav-link"><i class="bi bi-truck"></i> Shipment Status</a>
@endsection

@section('content')
<div class="mb-4">
    <h4 class="fw-bold" style="color:#1F3864;">Welcome, {{ Auth::user()->name }}! 👋</h4>
    <p class="text-muted">Track your orders and shipments.</p>
</div>
<div class="row g-3">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe;">
                <i class="bi bi-bag-check-fill" style="color:#2563eb;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">Total Orders</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef9c3;">
                <i class="bi bi-hourglass-split" style="color:#ca8a04;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">In Production</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7;">
                <i class="bi bi-truck" style="color:#16a34a;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">Shipped</p>
            </div>
        </div>
    </div>
</div>
@endsection