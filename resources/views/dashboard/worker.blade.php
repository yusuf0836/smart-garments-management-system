@extends('layouts.app')
@section('title', 'Worker Dashboard')
@section('page-title', 'Worker Dashboard')

@section('sidebar-menu')
    <div class="nav-section-title">My Menu</div>
    <a href="{{ route('worker.dashboard') }}" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="#" class="nav-link"><i class="bi bi-calendar-check"></i> My Attendance</a>
    <a href="#" class="nav-link"><i class="bi bi-list-task"></i> My Tasks</a>
    <a href="#" class="nav-link"><i class="bi bi-cash-stack"></i> Salary Slip</a>
@endsection

@section('content')
<div class="mb-4">
    <h4 class="fw-bold" style="color:#1F3864;">Welcome, {{ Auth::user()->name }}! 👋</h4>
    <p class="text-muted">View your daily tasks and attendance.</p>
</div>
<div class="row g-3">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7;">
                <i class="bi bi-calendar-check-fill" style="color:#16a34a;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">Days Present</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#dbeafe;">
                <i class="bi bi-list-task" style="color:#2563eb;"></i>
            </div>
            <div>
                <div class="stat-value">0</div>
                <p class="stat-label">Tasks Assigned</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef9c3;">
                <i class="bi bi-cash-stack" style="color:#ca8a04;"></i>
            </div>
            <div>
                <div class="stat-value">৳0</div>
                <p class="stat-label">This Month Salary</p>
            </div>
        </div>
    </div>
</div>
@endsection