@extends('layouts.app')
@section('title', 'Attendance')
@section('page-title', 'Attendance Management')

@section('sidebar-menu')
    <div class="nav-section-title">Main Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <div class="nav-section-title">Management</div>
    <a href="{{ route('admin.employees.index') }}" class="nav-link">
        <i class="bi bi-people"></i> Employees
    </a>
    <a href="{{ route('admin.attendance.index') }}" class="nav-link active">
        <i class="bi bi-calendar-check"></i> Attendance
    </a>
    <a href="#" class="nav-link"><i class="bi bi-box-seam"></i> Inventory</a>
    <a href="#" class="nav-link"><i class="bi bi-clipboard-check"></i> Orders</a>
    <a href="#" class="nav-link"><i class="bi bi-diagram-3"></i> Production</a>
    <div class="nav-section-title">Reports</div>
    <a href="#" class="nav-link"><i class="bi bi-bar-chart"></i> Analytics</a>
@endsection

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color:#1F3864;">Daily Attendance</h4>
        <p class="text-muted mb-0">Mark attendance for all employees</p>
    </div>
</div>

@if(session('success'))
<div class="alert d-flex align-items-center gap-2 mb-4"
     style="border-radius:8px;border:none;background:#dcfce7;color:#16a34a;">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
</div>
@endif

{{-- Date Selector --}}
<div class="content-card mb-4">
    <div class="content-card-body">
        <form method="GET" action="{{ route('admin.attendance.index') }}" class="d-flex align-items-center gap-3">
            <label class="fw-semibold" style="font-size:13px;white-space:nowrap;">Select Date:</label>
            <input type="date" name="date" class="form-control" style="max-width:200px;"
                   value="{{ $date }}" onchange="this.form.submit()">
            <span class="text-muted" style="font-size:13px;">
                {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
            </span>
        </form>
    </div>
</div>

{{-- Attendance Form --}}
<div class="content-card">
    <div class="content-card-header">
        <h6><i class="bi bi-calendar-check-fill me-2" style="color:#2E75B6;"></i>Attendance Sheet</h6>
        <span class="badge" style="background:#dbeafe;color:#2563eb;">
            {{ $employees->count() }} Employees
        </span>
    </div>
    <div class="content-card-body">
        @if($employees->count() > 0)
        <form action="{{ route('admin.attendance.store') }}" method="POST">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Shift</th>
                            <th>Status</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Overtime (hrs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $index => $emp)
                        @php $att = $attendances[$emp->id] ?? null; @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:32px;height:32px;background:#e0e7ff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#4338ca;font-size:12px;">
                                        {{ strtoupper(substr($emp->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:600;font-size:13px;">{{ $emp->name }}</div>
                                        <div style="font-size:11px;color:#888;">{{ $emp->employee_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:13px;">{{ $emp->department }}</td>
                            <td>
                                <span class="badge" style="background:#fef9c3;color:#854d0e;text-transform:capitalize;">
                                    {{ $emp->shift }}
                                </span>
                            </td>
                            <td>
                                <select name="attendances[{{ $emp->id }}][status]" class="form-select form-select-sm" style="min-width:110px;">
                                    @foreach(['present','absent','late','half_day','holiday'] as $s)
                                    <option value="{{ $s }}" {{ ($att && $att->status == $s) ? 'selected' : ($s=='present' && !$att ? 'selected' : '') }}>
                                        {{ ucfirst(str_replace('_',' ',$s)) }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="time" name="attendances[{{ $emp->id }}][check_in]"
                                       class="form-control form-control-sm" style="min-width:110px;"
                                       value="{{ $att->check_in ?? '08:00' }}">
                            </td>
                            <td>
                                <input type="time" name="attendances[{{ $emp->id }}][check_out]"
                                       class="form-control form-control-sm" style="min-width:110px;"
                                       value="{{ $att->check_out ?? '17:00' }}">
                            </td>
                            <td>
                                <input type="number" name="attendances[{{ $emp->id }}][overtime_hours]"
                                       class="form-control form-control-sm" style="width:80px;"
                                       value="{{ $att->overtime_hours ?? 0 }}" min="0" max="12" step="0.5">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn px-4 py-2 fw-semibold"
                        style="background:#2E75B6;color:white;border:none;border-radius:8px;">
                    <i class="bi bi-save me-1"></i> Save Attendance
                </button>
            </div>
        </form>
        @else
        <div class="text-center py-5 text-muted">
            <i class="bi bi-people" style="font-size:40px;display:block;margin-bottom:8px;"></i>
            No active employees found.
            <a href="{{ route('admin.employees.create') }}">Add employees first</a>
        </div>
        @endif
    </div>
</div>

@endsection